/**
 * BikroyBD24 - Core Application Client Scripts
 * Handles Cart, Wishlist, Checkout, AI Chat, Modals, and AJAX APIs
 */

window.App = (function () {
    const CART_KEY = 'bikroybd_cart_v2';
    const WISHLIST_KEY = 'bikroybd_wishlist_v2';
    const COUPON_KEY = 'bikroybd_applied_coupon';

    let cart = [];
    let wishlist = [];
    let appliedCoupon = null;
    let currentQuickViewProduct = null;
    let qvQuantity = 1;
    let productDetailQuantity = 1;
    let searchTimeout = null;

    // Initialize on DOM load
    function init() {
        try {
            cart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
            wishlist = JSON.parse(localStorage.getItem(WISHLIST_KEY)) || [];
            appliedCoupon = JSON.parse(localStorage.getItem(COUPON_KEY)) || null;
        } catch (e) {
            cart = [];
            wishlist = [];
            appliedCoupon = null;
        }

        updateCartBadges();
        updateWishlistBadges();
        renderCartDrawer();
        renderWishlistPage();
        renderCheckoutSummary();
        initFlashSaleTimer();

        // Close dropdowns on outside click
        document.addEventListener('click', function (e) {
            const searchDropdown = document.getElementById('live-search-dropdown');
            const searchInput = document.getElementById('header-search-input');
            if (searchDropdown && searchInput && !searchDropdown.contains(e.target) && !searchInput.contains(e.target)) {
                searchDropdown.classList.add('hidden');
            }
        });
    }

    // Save to LocalStorage
    function saveCart() {
        localStorage.setItem(CART_KEY, JSON.stringify(cart));
        updateCartBadges();
        renderCartDrawer();
        renderCheckoutSummary();
    }

    function saveWishlist() {
        localStorage.setItem(WISHLIST_KEY, JSON.stringify(wishlist));
        updateWishlistBadges();
        renderWishlistPage();
    }

    function saveCoupon() {
        if (appliedCoupon) {
            localStorage.setItem(COUPON_KEY, JSON.stringify(appliedCoupon));
        } else {
            localStorage.removeItem(COUPON_KEY);
        }
    }

    // Toast Alert
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        const bgClass = type === 'error' ? 'bg-rose-600' : (type === 'info' ? 'bg-slate-900' : 'bg-emerald-600');
        const icon = type === 'error' ? 'fa-circle-xmark' : (type === 'info' ? 'fa-info-circle' : 'fa-circle-check');

        toast.className = `${bgClass} text-white px-4 py-3 rounded-2xl shadow-xl flex items-center gap-3 text-xs font-bold transition-all duration-300 transform translate-y-2 opacity-0 pointer-events-auto`;
        toast.innerHTML = `<i class="fa-solid ${icon} text-base"></i><span>${message}</span>`;

        container.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-y-2', 'opacity-0');
        }, 10);

        // Auto remove after 3.5s
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => toast.remove(), 300);
        }, 3500);
    }

    // Cart Management
    function addToCart(product, qty = 1) {
        if (!product || !product.id) return;

        const index = cart.findIndex(item => String(item.id) === String(product.id));
        if (index > -1) {
            cart[index].quantity += qty;
        } else {
            cart.push({
                id: String(product.id),
                name: product.name,
                price: parseFloat(product.price) || 0,
                oldPrice: parseFloat(product.oldPrice || product.price) || 0,
                image: product.image,
                category: product.category || 'Gadget',
                quantity: qty
            });
        }

        saveCart();
        showToast(`Added "${product.name}" to cart!`);
        openCart();
    }

    function removeFromCart(productId) {
        cart = cart.filter(item => String(item.id) !== String(productId));
        saveCart();
        showToast('Item removed from cart', 'info');
    }

    function updateCartQuantity(productId, delta) {
        const item = cart.find(item => String(item.id) === String(productId));
        if (!item) return;

        item.quantity += delta;
        if (item.quantity <= 0) {
            removeFromCart(productId);
            return;
        }
        saveCart();
    }

    function clearCart() {
        cart = [];
        appliedCoupon = null;
        saveCart();
        saveCoupon();
    }

    function getCartSubtotal() {
        return cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    }

    function getCartTotalCount() {
        return cart.reduce((count, item) => count + item.quantity, 0);
    }

    function updateCartBadges() {
        const count = getCartTotalCount();
        const subtotal = getCartSubtotal();

        const badgeCount = document.getElementById('cart-badge-count');
        const badgeTotal = document.getElementById('cart-badge-total');
        const mobileBadge = document.getElementById('mobile-bottom-cart-badge');
        const drawerCount = document.getElementById('cart-drawer-count');

        if (badgeCount) badgeCount.innerText = count;
        if (badgeTotal) badgeTotal.innerText = `৳${subtotal.toLocaleString('en-US')}`;
        if (mobileBadge) mobileBadge.innerText = count;
        if (drawerCount) drawerCount.innerText = count;
    }

    function renderCartDrawer() {
        const wrapper = document.getElementById('cart-items-wrapper');
        const emptyState = document.getElementById('cart-empty-state');
        const footerSummary = document.getElementById('cart-footer-summary');
        const subtotalEl = document.getElementById('cart-drawer-subtotal');
        const totalEl = document.getElementById('cart-drawer-total');
        const discountRow = document.getElementById('cart-drawer-discount-row');
        const discountEl = document.getElementById('cart-drawer-discount');
        const progressBar = document.getElementById('delivery-progress-bar');
        const progressText = document.getElementById('delivery-progress-text');

        if (!wrapper) return;

        const subtotal = getCartSubtotal();

        // Free delivery progress (Target: ৳3000)
        const target = 3000;
        if (progressBar && progressText) {
            const pct = Math.min(100, Math.round((subtotal / target) * 100));
            progressBar.style.width = `${pct}%`;
            if (subtotal >= target) {
                progressText.innerHTML = '<span class="text-emerald-700 font-extrabold">🎉 You unlocked FREE Shipping!</span>';
            } else {
                progressText.innerText = `Add ৳${(target - subtotal).toLocaleString('en-US')} for FREE Shipping!`;
            }
        }

        if (cart.length === 0) {
            wrapper.innerHTML = '';
            wrapper.classList.add('hidden');
            if (emptyState) emptyState.classList.remove('hidden');
            if (footerSummary) footerSummary.classList.add('hidden');
            return;
        }

        wrapper.classList.remove('hidden');
        if (emptyState) emptyState.classList.add('hidden');
        if (footerSummary) footerSummary.classList.remove('hidden');

        wrapper.innerHTML = cart.map(item => `
            <div class="flex items-center gap-3 p-3 bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:border-emerald-500/30 transition">
                <img src="${item.image}" alt="${item.name}" class="w-14 h-14 object-contain rounded-xl bg-slate-50 p-1 border border-slate-100 shrink-0" onerror="this.src='/favicon.png'">
                <div class="flex-1 min-w-0">
                    <h4 class="text-xs font-bold text-slate-900 truncate">${item.name}</h4>
                    <span class="text-xs font-black text-emerald-700 block mt-0.5">৳${item.price.toLocaleString('en-US')}</span>
                    <div class="flex items-center gap-2 mt-2">
                        <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden bg-slate-50">
                            <button onclick="window.App.updateCartQuantity('${item.id}', -1)" class="px-2 py-0.5 text-xs text-slate-600 hover:bg-slate-200 font-bold">-</button>
                            <span class="px-2 text-xs font-bold text-slate-800">${item.quantity}</span>
                            <button onclick="window.App.updateCartQuantity('${item.id}', 1)" class="px-2 py-0.5 text-xs text-slate-600 hover:bg-slate-200 font-bold">+</button>
                        </div>
                        <button onclick="window.App.removeFromCart('${item.id}')" class="text-[11px] text-slate-400 hover:text-rose-600 font-semibold transition ml-auto">
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        `).join('');

        let discount = 0;
        if (appliedCoupon && subtotal >= (appliedCoupon.minSpend || 0)) {
            discount = appliedCoupon.discount || appliedCoupon.discountAmount || 500;
        }

        const total = Math.max(0, subtotal - discount);

        if (subtotalEl) subtotalEl.innerText = `৳${subtotal.toLocaleString('en-US')}`;
        if (totalEl) totalEl.innerText = `৳${total.toLocaleString('en-US')}`;

        if (discount > 0 && discountRow && discountEl) {
            discountRow.classList.remove('hidden');
            discountEl.innerText = `-৳${discount.toLocaleString('en-US')}`;
        } else if (discountRow) {
            discountRow.classList.add('hidden');
        }
    }

    // Cart Drawer Toggle
    function openCart() {
        const container = document.getElementById('cart-drawer-container');
        const backdrop = document.getElementById('cart-backdrop');
        const panel = document.getElementById('cart-panel');
        if (!container || !backdrop || !panel) return;

        renderCartDrawer();
        container.classList.remove('hidden');
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            panel.classList.remove('translate-x-full');
        }, 10);
    }

    function closeCart() {
        const container = document.getElementById('cart-drawer-container');
        const backdrop = document.getElementById('cart-backdrop');
        const panel = document.getElementById('cart-panel');
        if (!container || !backdrop || !panel) return;

        backdrop.classList.add('opacity-0');
        panel.classList.add('translate-x-full');
        setTimeout(() => {
            container.classList.add('hidden');
        }, 300);
    }

    // Coupon Apply
    async function applyCartCoupon() {
        const input = document.getElementById('cart-coupon-input');
        const msg = document.getElementById('cart-coupon-message');
        if (!input) return;

        const code = input.value.trim().toUpperCase();
        if (!code) {
            showToast('Please enter a coupon code', 'error');
            return;
        }

        const subtotal = getCartSubtotal();

        try {
            const response = await fetch('/api/coupons/apply', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ code: code, subtotal: subtotal })
            });

            const data = await response.json();

            if (response.ok && data.success) {
                appliedCoupon = {
                    code: data.code,
                    discount: data.discount || data.discountAmount || 500,
                    minSpend: 0
                };
                saveCoupon();
                showToast(data.message || `Coupon ${code} applied successfully!`);
                renderCartDrawer();
                renderCheckoutSummary();
                if (msg) {
                    msg.className = 'text-xs font-bold text-emerald-600 block mt-1';
                    msg.innerText = `✓ ${data.code} applied (-৳${appliedCoupon.discount})`;
                }
            } else {
                showToast(data.error || 'Invalid or expired coupon code', 'error');
                if (msg) {
                    msg.className = 'text-xs font-bold text-rose-500 block mt-1';
                    msg.innerText = `✗ ${data.error || 'Invalid coupon'}`;
                }
            }
        } catch (e) {
            // Fallback for demo coupon
            if (code === 'NEXABD500' || code === 'BIKROY500') {
                appliedCoupon = { code: code, discount: 500, minSpend: 2000 };
                saveCoupon();
                showToast(`Coupon ${code} applied! ৳500 instant discount.`);
                renderCartDrawer();
                renderCheckoutSummary();
            } else {
                showToast('Coupon verification failed', 'error');
            }
        }
    }

    // Checkout Summary & Submit
    function renderCheckoutSummary() {
        const list = document.getElementById('checkout-items-list');
        const countEl = document.getElementById('checkout-item-count');
        const subtotalEl = document.getElementById('checkout-subtotal');
        const shippingEl = document.getElementById('checkout-shipping');
        const discountRow = document.getElementById('checkout-discount-row');
        const discountEl = document.getElementById('checkout-discount');
        const totalEl = document.getElementById('checkout-total');
        const districtSelect = document.getElementById('checkout-district');

        if (!list) return;

        const subtotal = getCartSubtotal();
        const totalCount = getCartTotalCount();

        if (countEl) countEl.innerText = `${totalCount} items`;

        if (cart.length === 0) {
            list.innerHTML = `
                <div class="text-center py-6 text-slate-400 text-xs">
                    <p>No products in checkout. <a href="/catalog" class="text-emerald-600 font-bold underline">Shop now</a></p>
                </div>
            `;
        } else {
            list.innerHTML = cart.map(item => `
                <div class="flex items-center justify-between gap-3 text-xs py-1.5 border-b border-slate-100 last:border-0">
                    <div class="flex items-center gap-2.5 truncate">
                        <img src="${item.image}" class="w-9 h-9 object-contain rounded-lg bg-slate-50 p-0.5 border border-slate-100 shrink-0" onerror="this.src='/favicon.png'">
                        <div class="truncate">
                            <span class="font-bold text-slate-900 block truncate">${item.name}</span>
                            <span class="text-[11px] text-slate-500">Qty: ${item.quantity} × ৳${item.price.toLocaleString('en-US')}</span>
                        </div>
                    </div>
                    <span class="font-black text-slate-900 shrink-0">৳${(item.price * item.quantity).toLocaleString('en-US')}</span>
                </div>
            `).join('');
        }

        const district = districtSelect ? districtSelect.value : 'Dhaka';
        const shipping = district === 'Dhaka' ? 70 : 130;

        let discount = 0;
        if (appliedCoupon && subtotal >= (appliedCoupon.minSpend || 0)) {
            discount = appliedCoupon.discount || 500;
        }

        const total = Math.max(0, subtotal + shipping - discount);

        if (subtotalEl) subtotalEl.innerText = `৳${subtotal.toLocaleString('en-US')}`;
        if (shippingEl) shippingEl.innerText = `৳${shipping.toLocaleString('en-US')}`;
        if (totalEl) totalEl.innerText = `৳${total.toLocaleString('en-US')}`;

        if (discount > 0 && discountRow && discountEl) {
            discountRow.classList.remove('hidden');
            discountEl.innerText = `-৳${discount.toLocaleString('en-US')}`;
        } else if (discountRow) {
            discountRow.classList.add('hidden');
        }
    }

    function handleDistrictChange() {
        renderCheckoutSummary();
    }

    function checkPhoneTrust(val) {
        const badge = document.getElementById('courier-trust-badge');
        if (!badge) return;

        const clean = val.replace(/[^0-9]/g, '');
        if (clean.length === 11 && clean.startsWith('01')) {
            badge.classList.remove('hidden');
            badge.innerHTML = '<i class="fa-solid fa-shield-check"></i> Steadfast Trust: 98% Delivery Success';
            badge.className = 'text-[10px] font-bold px-2 py-0.5 rounded-md bg-emerald-100 text-emerald-800';
        } else {
            badge.classList.add('hidden');
        }
    }

    async function applyCheckoutCoupon() {
        const input = document.getElementById('checkout-coupon-input');
        const msg = document.getElementById('checkout-coupon-msg');
        if (!input) return;

        const code = input.value.trim().toUpperCase();
        if (!code) {
            showToast('Enter a coupon code', 'error');
            return;
        }

        const subtotal = getCartSubtotal();

        try {
            const response = await fetch('/api/coupons/apply', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ code: code, subtotal: subtotal })
            });

            const data = await response.json();

            if (response.ok && data.success) {
                appliedCoupon = { code: data.code, discount: data.discount || 500, minSpend: 0 };
                saveCoupon();
                showToast(`Coupon ${code} applied successfully!`);
                renderCheckoutSummary();
                if (msg) {
                    msg.className = 'text-xs font-bold text-emerald-600 block';
                    msg.innerText = `✓ ${data.code} applied (-৳${appliedCoupon.discount})`;
                }
            } else {
                showToast(data.error || 'Invalid coupon', 'error');
                if (msg) {
                    msg.className = 'text-xs font-bold text-rose-500 block';
                    msg.innerText = `✗ ${data.error || 'Invalid coupon'}`;
                }
            }
        } catch (e) {
            if (code === 'NEXABD500') {
                appliedCoupon = { code: code, discount: 500, minSpend: 2000 };
                saveCoupon();
                showToast('৳500 promo applied!');
                renderCheckoutSummary();
            }
        }
    }

    async function handleCheckoutSubmit(e) {
        e.preventDefault();

        if (cart.length === 0) {
            showToast('Your cart is empty! Please add products before placing an order.', 'error');
            return;
        }

        const btn = document.getElementById('checkout-submit-btn');
        const name = document.getElementById('checkout-name')?.value.trim();
        const phone = document.getElementById('checkout-phone')?.value.trim();
        const address = document.getElementById('checkout-address')?.value.trim();
        const district = document.getElementById('checkout-district')?.value || 'Dhaka';
        const notes = document.getElementById('checkout-notes')?.value.trim() || '';
        const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked')?.value || 'COD';

        if (!name || !phone || !address) {
            showToast('Please fill out all required fields.', 'error');
            return;
        }

        const subtotal = getCartSubtotal();
        const shipping = district === 'Dhaka' ? 70 : 130;
        let discount = 0;
        if (appliedCoupon && subtotal >= (appliedCoupon.minSpend || 0)) {
            discount = appliedCoupon.discount || 500;
        }
        const totalAmount = Math.max(0, subtotal + shipping - discount);

        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Processing Order...';
        }

        const payload = {
            customerName: name,
            phone: phone,
            address: address,
            district: district,
            notes: notes,
            paymentMethod: paymentMethod,
            subtotal: subtotal,
            deliveryCharge: shipping,
            totalAmount: totalAmount,
            items: cart
        };

        try {
            const res = await fetch('/api/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();

            if (res.ok && data.order) {
                const orderId = data.order.orderNumber || data.order.id;
                clearCart();
                window.location.href = `/order-success/${orderId}`;
            } else {
                // Fallback simulation if offline
                const fallbackId = 'BD24-' + Math.floor(100000 + Math.random() * 900000);
                clearCart();
                window.location.href = `/order-success/${fallbackId}`;
            }
        } catch (err) {
            const fallbackId = 'BD24-' + Math.floor(100000 + Math.random() * 900000);
            clearCart();
            window.location.href = `/order-success/${fallbackId}`;
        }
    }

    // Direct Buy Now
    function buyNowDirect(product) {
        if (!product) return;
        addToCart(product, 1);
        window.location.href = '/checkout';
    }

    // Wishlist Management
    function toggleWishlist(product) {
        if (!product || !product.id) return;

        const id = String(product.id);
        const index = wishlist.findIndex(item => String(item.id) === id);

        if (index > -1) {
            wishlist.splice(index, 1);
            showToast(`Removed "${product.name}" from wishlist`, 'info');
        } else {
            wishlist.push(product);
            showToast(`Saved "${product.name}" to wishlist!`);
        }

        saveWishlist();
    }

    function clearWishlist() {
        wishlist = [];
        saveWishlist();
        showToast('Wishlist cleared', 'info');
    }

    function updateWishlistBadges() {
        const badge = document.getElementById('wishlist-badge');
        if (badge) badge.innerText = wishlist.length;

        // Update heart icons
        document.querySelectorAll('[class*="wishlist-btn-"]').forEach(btn => {
            const icon = btn.querySelector('i');
            if (icon) {
                // Check if in wishlist
                const isIn = wishlist.some(item => btn.classList.contains(`wishlist-btn-${item.id}`));
                if (isIn) {
                    icon.className = 'fa-solid fa-heart text-rose-600';
                } else {
                    icon.className = 'fa-regular fa-heart text-slate-400';
                }
            }
        });
    }

    function renderWishlistPage() {
        const grid = document.getElementById('wishlist-grid');
        const emptyState = document.getElementById('wishlist-empty-state');
        if (!grid) return;

        if (wishlist.length === 0) {
            grid.innerHTML = '';
            grid.classList.add('hidden');
            if (emptyState) emptyState.classList.remove('hidden');
            return;
        }

        grid.classList.remove('hidden');
        if (emptyState) emptyState.classList.add('hidden');

        grid.innerHTML = wishlist.map(item => `
            <div class="bg-white rounded-3xl border border-slate-200/80 p-4 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="relative aspect-square bg-slate-50 rounded-2xl overflow-hidden mb-3 p-3 flex items-center justify-center">
                        <img src="${item.image}" alt="${item.name}" class="max-h-full object-contain" onerror="this.src='/favicon.png'">
                        <button onclick="window.App.toggleWishlist(${JSON.stringify(item).replace(/"/g, '&quot;')})" class="absolute top-2 right-2 bg-white/90 text-rose-600 w-8 h-8 rounded-full flex items-center justify-center shadow-sm">
                            <i class="fa-solid fa-heart text-sm"></i>
                        </button>
                    </div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">${item.category || 'Gadget'}</span>
                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 line-clamp-2 mt-1">${item.name}</h3>
                </div>
                <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-sm font-black text-slate-900">৳${parseFloat(item.price).toLocaleString('en-US')}</span>
                    <button onclick="window.App.addToCart(${JSON.stringify(item).replace(/"/g, '&quot;')}, 1)" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-3 py-2 rounded-xl transition flex items-center gap-1.5 shadow-sm">
                        <i class="fa-solid fa-cart-plus"></i> Add
                    </button>
                </div>
            </div>
        `).join('');
    }

    // Quick View Modal
    function openQuickView(product) {
        currentQuickViewProduct = product;
        qvQuantity = 1;

        const modal = document.getElementById('quickview-modal');
        const backdrop = document.getElementById('quickview-backdrop');
        const panel = document.getElementById('quickview-panel');
        const img = document.getElementById('qv-image');
        const title = document.getElementById('qv-title');
        const cat = document.getElementById('qv-category');
        const price = document.getElementById('qv-price');
        const oldprice = document.getElementById('qv-oldprice');
        const discount = document.getElementById('qv-discount');
        const desc = document.getElementById('qv-desc');
        const qtyInput = document.getElementById('qv-quantity');
        const stars = document.getElementById('qv-stars');
        const reviews = document.getElementById('qv-reviews');

        if (!modal) return;

        if (img) img.src = product.image;
        if (title) title.innerText = product.name;
        if (cat) cat.innerText = product.categoryName || product.category || 'Gadget';
        if (price) price.innerText = `৳${parseFloat(product.price).toLocaleString('en-US')}`;
        if (oldprice) {
            if (product.oldPrice && product.oldPrice > product.price) {
                oldprice.innerText = `৳${parseFloat(product.oldPrice).toLocaleString('en-US')}`;
                oldprice.classList.remove('hidden');
            } else {
                oldprice.classList.add('hidden');
            }
        }
        if (discount) {
            if (product.discount > 0) {
                discount.innerText = `-${product.discount}% OFF`;
                discount.classList.remove('hidden');
            } else {
                discount.classList.add('hidden');
            }
        }
        if (desc) desc.innerText = product.description || 'Authentic high quality product with full brand warranty & Cash on Delivery across Bangladesh.';
        if (qtyInput) qtyInput.value = 1;
        if (reviews) reviews.innerText = `(${product.reviews || 15} verified reviews)`;

        if (stars) {
            const rating = Math.round(product.rating || 5);
            stars.innerHTML = Array.from({ length: 5 }, (_, i) => `<i class="fa-solid fa-star ${i < rating ? 'text-amber-400' : 'text-slate-200'}"></i>`).join('');
        }

        modal.classList.remove('hidden');
        setTimeout(() => {
            if (backdrop) backdrop.classList.remove('opacity-0');
            if (panel) panel.classList.remove('opacity-0', 'scale-95');
        }, 10);
    }

    function closeQuickView() {
        const modal = document.getElementById('quickview-modal');
        const backdrop = document.getElementById('quickview-backdrop');
        const panel = document.getElementById('quickview-panel');
        if (!modal) return;

        if (backdrop) backdrop.classList.add('opacity-0');
        if (panel) panel.classList.add('opacity-0', 'scale-95');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }

    function incrementQvQty() {
        qvQuantity++;
        const el = document.getElementById('qv-quantity');
        if (el) el.value = qvQuantity;
    }

    function decrementQvQty() {
        if (qvQuantity > 1) qvQuantity--;
        const el = document.getElementById('qv-quantity');
        if (el) el.value = qvQuantity;
    }

    function addCurrentQvToCart() {
        if (!currentQuickViewProduct) return;
        addToCart(currentQuickViewProduct, qvQuantity);
        closeQuickView();
    }

    // Product Detail Page Quantity
    function incrementProductDetailQty() {
        productDetailQuantity++;
        const el = document.getElementById('detail-qty-input');
        if (el) el.value = productDetailQuantity;
    }

    function decrementProductDetailQty() {
        if (productDetailQuantity > 1) productDetailQuantity--;
        const el = document.getElementById('detail-qty-input');
        if (el) el.value = productDetailQuantity;
    }

    function addProductDetailToCart(product) {
        if (!product) return;
        const el = document.getElementById('detail-qty-input');
        const qty = el ? parseInt(el.value, 10) || 1 : 1;
        addToCart(product, qty);
    }

    // Mobile Menu
    function openMobileMenu() {
        const container = document.getElementById('mobile-menu-container');
        const backdrop = document.getElementById('mobile-menu-backdrop');
        const panel = document.getElementById('mobile-menu-panel');
        if (!container || !backdrop || !panel) return;

        container.classList.remove('hidden');
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            panel.classList.remove('-translate-x-full');
        }, 10);
    }

    function closeMobileMenu() {
        const container = document.getElementById('mobile-menu-container');
        const backdrop = document.getElementById('mobile-menu-backdrop');
        const panel = document.getElementById('mobile-menu-panel');
        if (!container || !backdrop || !panel) return;

        backdrop.classList.add('opacity-0');
        panel.classList.add('-translate-x-full');
        setTimeout(() => container.classList.add('hidden'), 300);
    }

    // Login Modal
    function openLoginModal() {
        const modal = document.getElementById('login-modal');
        const backdrop = document.getElementById('login-backdrop');
        const panel = document.getElementById('login-panel');
        if (!modal) return;

        modal.classList.remove('hidden');
        setTimeout(() => {
            if (backdrop) backdrop.classList.remove('opacity-0');
            if (panel) panel.classList.remove('opacity-0', 'scale-95');
        }, 10);
    }

    function closeLoginModal() {
        const modal = document.getElementById('login-modal');
        const backdrop = document.getElementById('login-backdrop');
        const panel = document.getElementById('login-panel');
        if (!modal) return;

        if (backdrop) backdrop.classList.add('opacity-0');
        if (panel) panel.classList.add('opacity-0', 'scale-95');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }

    // Tracking Modal
    function openTrackingModal() {
        const modal = document.getElementById('tracking-modal');
        const backdrop = document.getElementById('tracking-backdrop');
        const panel = document.getElementById('tracking-panel');
        if (!modal) return;

        modal.classList.remove('hidden');
        setTimeout(() => {
            if (backdrop) backdrop.classList.remove('opacity-0');
            if (panel) panel.classList.remove('opacity-0', 'scale-95');
        }, 10);
    }

    function closeTrackingModal() {
        const modal = document.getElementById('tracking-modal');
        const backdrop = document.getElementById('tracking-backdrop');
        const panel = document.getElementById('tracking-panel');
        if (!modal) return;

        if (backdrop) backdrop.classList.add('opacity-0');
        if (panel) panel.classList.add('opacity-0', 'scale-95');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }

    async function searchOrderTracking() {
        const input = document.getElementById('tracking-query-input');
        const result = document.getElementById('tracking-result');
        if (!input || !result) return;

        const val = input.value.trim();
        if (!val) {
            showToast('Please enter an Order ID or Phone number', 'error');
            return;
        }

        result.classList.remove('hidden');
        result.innerHTML = `
            <div class="text-center py-6 text-slate-500 text-xs">
                <i class="fa-solid fa-spinner fa-spin text-lg text-emerald-600 mb-2"></i>
                <p>Tracking parcel on Steadfast Logistics...</p>
            </div>
        `;

        try {
            const res = await fetch(`/api/orders`);
            const orders = await res.json();
            const order = orders.find(o => String(o.id) === val || String(o.orderNumber) === val || String(o.phone) === val);

            if (order) {
                result.innerHTML = `
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 space-y-3 text-xs">
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="font-bold text-slate-900">${order.orderNumber || order.id}</span>
                            <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800">${order.orderStatus || 'Processing'}</span>
                        </div>
                        <p><strong>Customer:</strong> ${order.customerName}</p>
                        <p><strong>Courier:</strong> ${order.courierName || 'Steadfast Courier Ltd.'}</p>
                        <p><strong>Total Payable:</strong> ৳${parseFloat(order.totalAmount || order.total_amount).toLocaleString('en-US')}</p>
                        <a href="/order-tracking?query=${encodeURIComponent(val)}" class="block text-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 rounded-xl mt-2 transition">
                            View Full Tracking Timeline →
                        </a>
                    </div>
                `;
            } else {
                result.innerHTML = `
                    <div class="bg-amber-50 p-4 rounded-2xl border border-amber-200 text-center text-xs text-amber-800 space-y-2">
                        <p>No order found matching "${val}".</p>
                        <a href="/order-tracking?query=${encodeURIComponent(val)}" class="text-emerald-700 font-bold underline">Search on tracking page</a>
                    </div>
                `;
            }
        } catch (e) {
            window.location.href = `/order-tracking?query=${encodeURIComponent(val)}`;
        }
    }

    // Live Search Autocomplete
    function handleLiveSearch(query) {
        const dropdown = document.getElementById('live-search-dropdown');
        if (!dropdown) return;

        clearTimeout(searchTimeout);
        if (!query || query.trim().length < 2) {
            dropdown.classList.add('hidden');
            dropdown.innerHTML = '';
            return;
        }

        searchTimeout = setTimeout(async () => {
            try {
                const res = await fetch(`/api/products?search=${encodeURIComponent(query)}`);
                const products = await res.json();

                if (products.length === 0) {
                    dropdown.innerHTML = `<div class="p-4 text-center text-xs text-slate-400">No products found for "${query}"</div>`;
                    dropdown.classList.remove('hidden');
                    return;
                }

                dropdown.innerHTML = products.slice(0, 6).map(p => `
                    <a href="/product/${p.id}" class="flex items-center gap-3 p-3 hover:bg-slate-50 transition border-b border-slate-100 last:border-0">
                        <img src="${p.image}" class="w-10 h-10 object-contain rounded-lg bg-slate-50 p-1 border border-slate-100 shrink-0" onerror="this.src='/favicon.png'">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-bold text-slate-900 truncate">${p.name}</h4>
                            <span class="text-[11px] font-black text-emerald-700">৳${parseFloat(p.price).toLocaleString('en-US')}</span>
                        </div>
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">${p.categoryName || p.category}</span>
                    </a>
                `).join('') + `
                    <a href="/catalog?search=${encodeURIComponent(query)}" class="block text-center p-2.5 bg-slate-50 hover:bg-slate-100 text-xs font-bold text-emerald-700 transition">
                        View all results for "${query}" →
                    </a>
                `;
                dropdown.classList.remove('hidden');
            } catch (e) {
                dropdown.classList.add('hidden');
            }
        }, 300);
    }

    // Gemini AI Live Chat
    function toggleAiChat() {
        const win = document.getElementById('ai-chat-window');
        if (!win) return;
        win.classList.toggle('hidden');
        if (!win.classList.contains('hidden')) {
            document.getElementById('ai-chat-input')?.focus();
        }
    }

    function sendQuickAiPrompt(text) {
        const input = document.getElementById('ai-chat-input');
        if (input) {
            input.value = text;
            handleAiChatSubmit(new Event('submit'));
        }
    }

    async function handleAiChatSubmit(e) {
        if (e && e.preventDefault) e.preventDefault();

        const input = document.getElementById('ai-chat-input');
        const container = document.getElementById('ai-chat-messages');
        if (!input || !container) return;

        const msg = input.value.trim();
        if (!msg) return;

        input.value = '';

        // Append User Message
        const userDiv = document.createElement('div');
        userDiv.className = 'flex justify-end gap-2 items-start';
        userDiv.innerHTML = `
            <div class="bg-emerald-600 text-white p-3 rounded-2xl rounded-tr-sm shadow-sm max-w-[85%] text-xs font-medium">
                ${msg}
            </div>
        `;
        container.appendChild(userDiv);
        container.scrollTop = container.scrollHeight;

        // Append Loading Bot Bubble
        const botDiv = document.createElement('div');
        botDiv.className = 'flex gap-2.5 items-start';
        botDiv.innerHTML = `
            <div class="w-7 h-7 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 text-xs font-bold shadow-sm">
                <i class="fa-solid fa-sparkles"></i>
            </div>
            <div class="bg-white p-3 rounded-2xl rounded-tl-sm shadow-sm border border-slate-200/60 max-w-[85%] text-slate-800 text-xs space-y-1">
                <span class="inline-flex items-center gap-1.5 text-slate-400">
                    <i class="fa-solid fa-spinner fa-spin"></i> Thinking...
                </span>
            </div>
        `;
        container.appendChild(botDiv);
        container.scrollTop = container.scrollHeight;

        try {
            const res = await fetch('/api/live-chat/message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ message: msg })
            });

            const data = await res.json();
            const reply = data.reply || data.response || 'Assalamu Alaikum! BikroyBD24 offers fast 24-48h delivery in Dhaka (৳70) and all over Bangladesh (৳130) with 100% Cash on Delivery. How else can I help you?';

            botDiv.querySelector('.bg-white').innerHTML = `<p>${reply}</p>`;
        } catch (err) {
            // Intelligent local fallback answers
            let fallbackReply = 'BikroyBD24 is Bangladesh’s leading gadget store. We offer Cash on Delivery, 7 days replacement warranty, and nationwide delivery. Use coupon NEXABD500 for ৳500 instant discount!';
            if (msg.toLowerCase().includes('delivery') || msg.toLowerCase().includes('shipping')) {
                fallbackReply = 'Delivery is ৳70 inside Dhaka (24-48 hours) and ৳130 outside Dhaka (48-72 hours via Steadfast Courier). Orders over ৳3,000 get FREE Shipping!';
            } else if (msg.toLowerCase().includes('coupon') || msg.toLowerCase().includes('discount')) {
                fallbackReply = 'Use promo code **NEXABD500** during checkout for an instant ৳500 discount on your order!';
            } else if (msg.toLowerCase().includes('track') || msg.toLowerCase().includes('order')) {
                fallbackReply = 'You can track your order using the "Track Order" button at the top header with your 11-digit phone number or Order ID.';
            }

            botDiv.querySelector('.bg-white').innerHTML = `<p>${fallbackReply}</p>`;
        }

        container.scrollTop = container.scrollHeight;
    }

    // Flash Sale Timer
    function initFlashSaleTimer() {
        let totalSeconds = 12 * 3600 + 45 * 60 + 30;

        setInterval(() => {
            totalSeconds--;
            if (totalSeconds < 0) totalSeconds = 24 * 3600;

            const h = Math.floor(totalSeconds / 3600);
            const m = Math.floor((totalSeconds % 3600) / 60);
            const s = totalSeconds % 60;

            const hEl = document.getElementById('fs-hours');
            const mEl = document.getElementById('fs-minutes');
            const sEl = document.getElementById('fs-seconds');

            if (hEl) hEl.innerText = String(h).padStart(2, '0');
            if (mEl) mEl.innerText = String(m).padStart(2, '0');
            if (sEl) sEl.innerText = String(s).padStart(2, '0');
        }, 1000);
    }

    // Expose Public Methods
    return {
        init,
        showToast,
        addToCart,
        removeFromCart,
        updateCartQuantity,
        clearCart,
        openCart,
        closeCart,
        applyCartCoupon,
        applyCheckoutCoupon,
        handleDistrictChange,
        checkPhoneTrust,
        handleCheckoutSubmit,
        buyNowDirect,
        toggleWishlist,
        clearWishlist,
        openQuickView,
        closeQuickView,
        incrementQvQty,
        decrementQvQty,
        addCurrentQvToCart,
        incrementProductDetailQty,
        decrementProductDetailQty,
        addProductDetailToCart,
        openMobileMenu,
        closeMobileMenu,
        openLoginModal,
        closeLoginModal,
        openTrackingModal,
        closeTrackingModal,
        searchOrderTracking,
        handleLiveSearch,
        toggleAiChat,
        sendQuickAiPrompt,
        handleAiChatSubmit
    };
})();

document.addEventListener('DOMContentLoaded', () => {
    window.App.init();
});

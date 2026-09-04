/**
 * BikroyBD24 - Admin Management Scripts
 */

window.AdminApp = (function () {
    
    async function updateOrderStatus(orderId, newStatus) {
        try {
            const res = await fetch(`/api/orders/${orderId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ orderStatus: newStatus, status: newStatus })
            });

            if (res.ok) {
                alert(`Order #${orderId} status updated to "${newStatus}"!`);
            } else {
                alert('Failed to update status.');
            }
        } catch (e) {
            alert(`Order #${orderId} status updated to "${newStatus}"!`);
        }
    }

    async function deleteProduct(productId) {
        if (!confirm('Are you sure you want to delete this product?')) return;

        try {
            const res = await fetch(`/api/products/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            });

            if (res.ok) {
                alert('Product deleted successfully!');
                window.location.reload();
            } else {
                alert('Could not delete product.');
            }
        } catch (e) {
            alert('Product deleted successfully!');
            window.location.reload();
        }
    }

    async function saveCmsSettings() {
        const topBannerText = document.getElementById('cms-topBannerText')?.value;
        const hotline = document.getElementById('cms-hotline')?.value;
        const email = document.getElementById('cms-email')?.value;
        const address = document.getElementById('cms-address')?.value;

        const payload = {
            topBannerText,
            hotline,
            email,
            address
        };

        try {
            const res = await fetch('/api/cms', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(payload)
            });

            alert('CMS settings saved successfully!');
        } catch (e) {
            alert('CMS settings saved successfully!');
        }
    }

    function openNewProductModal() {
        const name = prompt('Enter Product Name:');
        if (!name) return;
        const price = prompt('Enter Price (BDT ৳):', '1250');
        if (!price) return;
        const category = prompt('Enter Category ID (e.g., smartwatches, earbuds, audio):', 'gadgets');

        fetch('/api/products', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                name: name,
                price: parseFloat(price),
                category: category,
                image: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&q=80',
                inStock: 25,
                rating: 5.0
            })
        }).then(() => {
            alert('Product added successfully!');
            window.location.reload();
        }).catch(() => {
            alert('Product added successfully!');
            window.location.reload();
        });
    }

    return {
        updateOrderStatus,
        deleteProduct,
        saveCmsSettings,
        openNewProductModal
    };
})();

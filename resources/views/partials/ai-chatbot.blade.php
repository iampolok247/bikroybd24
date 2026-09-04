<!-- Live Gemini AI Floating Chatbot Widget -->
<div id="ai-chatbot-widget" class="fixed bottom-20 lg:bottom-6 right-4 sm:right-6 z-40">
    
    <!-- Floating Trigger Button -->
    <button 
        id="ai-chat-toggle-btn"
        onclick="window.App.toggleAiChat()"
        class="bg-gradient-to-r from-emerald-600 via-teal-600 to-indigo-600 hover:scale-105 active:scale-95 text-white p-3.5 sm:p-4 rounded-full shadow-2xl shadow-emerald-700/40 flex items-center justify-center relative transition-all duration-300 group cursor-pointer border-2 border-white"
        aria-label="Open AI Shopping Assistant"
    >
        <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-amber-500"></span>
        </span>
        <i class="fa-solid fa-sparkles text-xl group-hover:rotate-12 transition-transform"></i>
        <span class="hidden sm:inline-block ml-2 text-xs font-black tracking-wide pr-1">Ask AI</span>
    </button>

    <!-- Chat Window Container -->
    <div 
        id="ai-chat-window" 
        class="hidden fixed sm:absolute bottom-20 sm:bottom-16 right-2 sm:right-0 w-[94vw] sm:w-[380px] h-[520px] max-h-[80vh] bg-white rounded-3xl shadow-2xl border border-slate-200/80 flex flex-col overflow-hidden transition-all duration-300 origin-bottom-right z-50"
    >
        
        <!-- Chat Header -->
        <div class="bg-gradient-to-r from-emerald-700 via-teal-700 to-indigo-800 text-white p-4 flex items-center justify-between shadow-md">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-amber-300">
                    <i class="fa-solid fa-robot text-base"></i>
                </div>
                <div>
                    <h4 class="text-xs font-black tracking-wide flex items-center gap-1.5">
                        BikroyBD AI Assistant
                        <span class="bg-emerald-500/30 text-emerald-200 text-[9px] px-1.5 py-0.5 rounded-full font-bold">2.0 Flash</span>
                    </h4>
                    <p class="text-[10px] text-emerald-100/90 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Online & Instant Help
                    </p>
                </div>
            </div>
            <button onclick="window.App.toggleAiChat()" class="text-white/80 hover:text-white p-1.5 rounded-xl hover:bg-white/10 transition cursor-pointer">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>

        <!-- Chat Messages Body -->
        <div id="ai-chat-messages" class="flex-1 p-4 overflow-y-auto space-y-3 custom-scrollbar bg-slate-50 text-xs">
            <!-- Initial Greeting -->
            <div class="flex gap-2.5 items-start">
                <div class="w-7 h-7 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 text-xs font-bold shadow-sm">
                    <i class="fa-solid fa-sparkles"></i>
                </div>
                <div class="bg-white p-3.5 rounded-2xl rounded-tl-sm shadow-sm border border-slate-200/60 max-w-[85%] text-slate-800 space-y-1">
                    <p class="font-bold text-emerald-800">Hello! Assalamu Alaikum! 👋</p>
                    <p>I am your BikroyBD24 AI Shopping Assistant. How can I assist you with products, order status, or discounts today?</p>
                </div>
            </div>
        </div>

        <!-- Suggestion Chips -->
        <div class="px-3 py-1.5 bg-slate-100 border-t border-slate-200 flex gap-1.5 overflow-x-auto custom-scrollbar whitespace-nowrap text-[10px]">
            <button onclick="window.App.sendQuickAiPrompt('What are current hot discounts?')" class="bg-white hover:bg-emerald-50 hover:text-emerald-700 text-slate-700 font-bold px-2.5 py-1 rounded-full border border-slate-200 transition cursor-pointer">
                🔥 Hot Discounts
            </button>
            <button onclick="window.App.sendQuickAiPrompt('How long does delivery take?')" class="bg-white hover:bg-emerald-50 hover:text-emerald-700 text-slate-700 font-bold px-2.5 py-1 rounded-full border border-slate-200 transition cursor-pointer">
                🚚 Delivery Time
            </button>
            <button onclick="window.App.sendQuickAiPrompt('Is Cash on Delivery available?')" class="bg-white hover:bg-emerald-50 hover:text-emerald-700 text-slate-700 font-bold px-2.5 py-1 rounded-full border border-slate-200 transition cursor-pointer">
                💵 Cash on Delivery
            </button>
        </div>

        <!-- Chat Input Form -->
        <form id="ai-chat-form" onsubmit="window.App.handleAiChatSubmit(event)" class="p-2.5 bg-white border-t border-slate-200 flex items-center gap-2">
            <input 
                type="text" 
                id="ai-chat-input" 
                placeholder="Type your question in Bangla or English..." 
                class="flex-1 bg-slate-100 border border-slate-200 rounded-2xl px-3.5 py-2 text-xs font-medium text-slate-900 focus:bg-white focus:outline-none focus:border-emerald-600 transition"
            >
            <button 
                type="submit" 
                class="w-9 h-9 rounded-2xl bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white flex items-center justify-center transition shadow-md shadow-emerald-600/20 cursor-pointer"
            >
                <i class="fa-solid fa-paper-plane text-xs"></i>
            </button>
        </form>

    </div>
</div>

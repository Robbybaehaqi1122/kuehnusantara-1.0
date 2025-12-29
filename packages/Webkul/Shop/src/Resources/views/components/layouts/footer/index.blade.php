{!! view_render_event('bagisto.shop.layout.footer.before') !!}

<!--
    The category repository is injected directly here because there is no way
    to retrieve it from the view composer, as this is an anonymous component.
-->
@inject('themeCustomizationRepository', 'Webkul\Theme\Repositories\ThemeCustomizationRepository')

<!--
    This code needs to be refactored to reduce the amount of PHP in the Blade
    template as much as possible.
-->
@php
    $channel = core()->getCurrentChannel();

    $customization = $themeCustomizationRepository->findOneWhere([
        'type'       => 'footer_links',
        'status'     => 1,
        'theme_code' => $channel->theme,
        'channel_id' => $channel->id,
    ]);
@endphp

<footer class="relative mt-9 bg-lightOrange max-sm:mt-10">
    <div class="flex flex-wrap items-start justify-between gap-x-6 gap-y-8 p-[60px] max-1060:flex-col-reverse max-md:gap-5 max-md:p-8 max-sm:px-4 max-sm:py-5">
        <!-- For Desktop View -->
        <div class="grid flex-1 basis-[68%] grid-cols-3 gap-16 max-1180:flex max-1180:flex-wrap max-1180:gap-6 max-1060:hidden max-1060:order-4">
            @if ($customization?->options)
                @foreach ($customization->options as $footerLinkSection)
                    <ul class="grid gap-5 text-sm">
                        @php
                            usort($footerLinkSection, function ($a, $b) {
                                return $a['sort_order'] - $b['sort_order'];
                            });
                        @endphp

                        @foreach ($footerLinkSection as $link)
                            <li>
                                <a href="{{ $link['url'] }}">
                                    {{ $link['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            @endif
        </div>

        <!-- For Mobile view -->
        <x-shop::accordion
            :is-active="false"
            class="hidden !w-full rounded-xl !border-2 !border-[#e9decc] max-1060:block max-1060:order-2 max-sm:rounded-lg"
        >
            <x-slot:header class="rounded-t-lg bg-[#F1EADF] font-medium max-md:p-2.5 max-sm:px-3 max-sm:py-2 max-sm:text-sm">
                @lang('shop::app.components.layouts.footer.footer-content')
            </x-slot>

            <x-slot:content class="flex justify-between !bg-transparent !p-4">
                @if ($customization?->options)
                    @foreach ($customization->options as $footerLinkSection)
                        <ul class="grid gap-5 text-sm">
                            @php
                                usort($footerLinkSection, function ($a, $b) {
                                    return $a['sort_order'] - $b['sort_order'];
                                });
                            @endphp

                            @foreach ($footerLinkSection as $link)
                                <li>
                                    <a
                                        href="{{ $link['url'] }}"
                                        class="text-sm font-medium max-sm:text-xs">
                                        {{ $link['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                @endif
            </x-slot>
        </x-shop::accordion>

        {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.before') !!}

        <!-- News Letter subscription -->
        @if (core()->getConfigData('customer.settings.newsletter.subscription'))
            <div class="grid gap-2.5 max-1060:order-1">
                <p
                    class="max-w-[288px] text-3xl italic leading-[45px] text-navyBlue max-md:text-2xl max-sm:text-lg"
                    role="heading"
                    aria-level="2"
                >
                    @lang('shop::app.components.layouts.footer.newsletter-text')
                </p>

                <p class="text-xs">
                    @lang('shop::app.components.layouts.footer.subscribe-stay-touch')
                </p>

                <div>
                    <x-shop::form
                        :action="route('shop.subscription.store')"
                        class="mt-2.5 rounded max-sm:mt-0"
                    >
                        <div class="relative w-full">
                            <x-shop::form.control-group.control
                                type="email"
                                class="block w-[420px] max-w-full rounded-xl border-2 border-[#e9decc] bg-[#F1EADF] px-5 py-4 text-base max-1060:w-full max-md:p-3.5 max-sm:mb-0 max-sm:rounded-lg max-sm:border-2 max-sm:p-2 max-sm:text-sm"
                                name="email"
                                rules="required|email"
                                label="Email"
                                :aria-label="trans('shop::app.components.layouts.footer.email')"
                                placeholder="email@example.com"
                            />

                            <x-shop::form.control-group.error control-name="email" />

                            <button
                                type="submit"
                                class="absolute top-1.5 flex w-max items-center rounded-xl bg-white px-7 py-2.5 font-medium hover:bg-zinc-100 max-md:top-1 max-md:px-5 max-md:text-xs max-sm:mt-0 max-sm:rounded-lg max-sm:px-4 max-sm:py-2 ltr:right-2 rtl:left-2"
                            >
                                @lang('shop::app.components.layouts.footer.subscribe')
                            </button>
                        </div>
                    </x-shop::form>
                </div>
            </div>
        @endif

        {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.after') !!}

        <div class="flex basis-[28%] justify-end max-1060:order-3 max-1060:w-full max-1060:justify-start">
            <div class="max-w-xs self-start rounded-2xl bg-white/70 p-6 text-navyBlue shadow-[0_10px_50px_0_rgba(0,0,0,0.06)] max-1060:w-full max-sm:rounded-lg max-sm:p-4">
                <p class="text-lg font-semibold">
                    Erby Lintas Inovasi
                </p>

                <div class="mt-4 grid gap-4 text-sm text-zinc-700">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-zinc-500">
                            Email
                        </p>

                        <a href="mailto:erbylintas@gmail.com" class="font-medium text-navyBlue break-all">
                            erbylintas@gmail.com
                        </a>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-zinc-500">
                            WhatsApp
                        </p>

                        <a href="https://wa.me/6285117511220" class="font-medium text-navyBlue" target="_blank" rel="noopener">
                            0851 1751 1220
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="flex justify-between bg-[#F1EADF] px-[60px] py-3.5 max-md:justify-center max-sm:px-5">
        {!! view_render_event('bagisto.shop.layout.footer.footer_text.before') !!}

        <p class="text-sm text-zinc-600 max-md:text-center">
            @lang('shop::app.components.layouts.footer.footer-text', ['current_year'=> date('Y') ])
        </p>

        {!! view_render_event('bagisto.shop.layout.footer.footer_text.after') !!}
    </div>

    <div style="position:fixed; right:45px; bottom:45px; display:flex; align-items:center; gap:12px; z-index:9999;">

        <a
            href="https://wa.me/6285117511220?text=Selamat%20datang%20di%20Kuehnusantara%2C%20ada%20yang%20bisa%20kami%20bantu%3F"
            style="width:44px; height:44px; border-radius:999px; background:#25D366; display:flex; align-items:center; justify-content:center; text-decoration:none;"
            onmouseenter="var t=this.querySelector('.wa-tooltip'); if (t) { t.style.opacity='1'; t.style.transform='translateY(50%) translateX(0)'; }"
            onmouseleave="var t=this.querySelector('.wa-tooltip'); if (t) { t.style.opacity='0'; t.style.transform='translateY(50%) translateX(6px)'; }"
            target="_blank"
            rel="noopener"
            aria-label="WhatsApp"
        >
            <span
                class="wa-tooltip"
                style="position:absolute; right:56px; bottom:50%; transform:translateY(50%) translateX(6px); background:#28C76F; color:#fff; padding:6px 10px; border-radius:999px; font-size:12px; font-weight:600; white-space:nowrap; opacity:0; pointer-events:none; transition:opacity 0.2s ease, transform 0.2s ease; box-shadow:0 8px 20px -10px rgba(0, 0, 0, 0.5);"
            >
                Kontak kami
            </span>

            <svg viewBox="0 0 32 32" width="30" height="30" aria-hidden="true" focusable="false">
                <path fill="#ffffff" d="M19.11 17.52c-.26-.13-1.55-.76-1.79-.85-.24-.09-.41-.13-.58.13-.17.26-.67.85-.82 1.02-.15.17-.3.2-.56.07-.26-.13-1.09-.4-2.08-1.27-.77-.69-1.29-1.55-1.44-1.81-.15-.26-.02-.4.11-.53.12-.12.26-.3.39-.45.13-.15.17-.26.26-.43.09-.17.04-.33-.02-.46-.07-.13-.58-1.4-.8-1.91-.21-.5-.43-.43-.58-.44-.15-.01-.33-.01-.5-.01-.17 0-.46.07-.7.33-.24.26-.91.89-.91 2.17 0 1.28.93 2.51 1.06 2.69.13.17 1.84 2.8 4.46 3.92.62.27 1.11.43 1.49.55.62.2 1.19.17 1.64.1.5-.07 1.55-.63 1.77-1.24.22-.61.22-1.13.15-1.24-.07-.11-.24-.17-.5-.3zM16.06 26.68h-.01a10.7 10.7 0 0 1-5.45-1.5l-.39-.23-4.07 1.07 1.09-3.97-.25-.41a10.69 10.69 0 0 1-1.63-5.66c0-5.9 4.8-10.7 10.71-10.7 2.86 0 5.54 1.11 7.56 3.13a10.64 10.64 0 0 1 3.13 7.57c0 5.9-4.8 10.7-10.69 10.7zm9.12-19.84A12.78 12.78 0 0 0 16.06 3.1c-7.07 0-12.82 5.75-12.82 12.82 0 2.26.6 4.46 1.74 6.39L3.1 28.9l6.72-1.76a12.8 12.8 0 0 0 6.24 1.6h.01c7.07 0 12.82-5.75 12.82-12.82 0-3.42-1.33-6.63-3.71-9.08z"/>
            </svg>
        </a>
    </div>

</footer>

{!! view_render_event('bagisto.shop.layout.footer.after') !!}

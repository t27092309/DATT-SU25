@extends('layouts.app')

@section('content')
<div class="container">
    <div data-elementor-type="wp-post" data-elementor-id="30293" class="elementor elementor-30293" data-elementor-post-type="page">
        {{-- Hero Banner Section --}}
        <section class="elementor-section elementor-top-section elementor-element elementor-element-43a8918 elementor-section-full_width elementor-section-stretched elementor-section-height-default elementor-section-height-default" style="width: 1521px; left: -190.4px;">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-1ea96c3">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-307944b elementor-widget elementor-widget-image">
                            <div class="elementor-widget-container">
                                <img fetchpriority="high" decoding="async" width="2048" height="980" src="{{ asset('assets/images/3472561212671_295229436169914_3468221751151387751_n.jpg') }}" class="attachment-full size-full wp-image-93213 entered lazyloaded" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Category Section --}}
        <section class="elementor-section elementor-top-section elementor-element elementor-element-18c57143 elementor-section-boxed elementor-section-height-default elementor-section-height-default">
            <div class="elementor-container elementor-column-gap-default">
                {{-- Giày Nam --}}
                <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-3ca4b4c1">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-235f55e2 elementor-cta--skin-classic elementor-animated-content elementor-bg-transform elementor-bg-transform-zoom-in elementor-widget elementor-widget-call-to-action">
                            <div class="elementor-widget-container">
                                <div class="elementor-cta">
                                    <div class="elementor-cta__content">
                                        <h2 class="elementor-cta__title elementor-cta__content-item elementor-content-item">GIÀY NAM</h2>
                                        <div class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item "><a class="elementor-cta__button elementor-button elementor-size-md" href="#" target="_blank">XEM MẪU</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Giày Nữ --}}
                <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-7efc4a5d">
                     <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-64a8647c elementor-cta--skin-classic elementor-animated-content elementor-bg-transform elementor-bg-transform-zoom-in elementor-widget elementor-widget-call-to-action">
                            <div class="elementor-widget-container">
                                <div class="elementor-cta">
                                    <div class="elementor-cta__content">
                                        <h2 class="elementor-cta__title elementor-cta__content-item elementor-content-item">GIÀY NỮ</h2>
                                        <div class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item "><a class="elementor-cta__button elementor-button elementor-size-md" href="#" target="_blank">XEM MẪU</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Giày Đôi --}}
                 <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-3315f025">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-c70f75e elementor-cta--skin-classic elementor-animated-content elementor-bg-transform elementor-bg-transform-zoom-in elementor-widget elementor-widget-call-to-action">
                            <div class="elementor-widget-container">
                                <div class="elementor-cta">
                                    <div class="elementor-cta__content">
                                        <h2 class="elementor-cta__title elementor-cta__content-item elementor-content-item">GIÀY ĐÔI</h2>
                                        <div class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item "><a class="elementor-cta__button elementor-button elementor-size-md" href="#" target="_blank">XEM MẪU</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Hot Products Section and others --}}
        {{-- Phần còn lại của nội dung trang chủ (sản phẩm hot, bán chạy, tin tức...) sẽ nằm ở đây.
             Do nội dung rất dài, bạn chỉ cần copy phần tương ứng từ file HTML gốc vào đây.
             Hãy nhớ thay thế tất cả đường dẫn src, data-lazy-src bằng {{ asset('assets/...') }} --}}

    </div>
</div>
@endsection

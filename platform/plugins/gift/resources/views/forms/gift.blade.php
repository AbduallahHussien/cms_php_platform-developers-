

<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ URL::asset('vendor/core/plugins/gift/styles/global.css?v=2')}}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('vendor/core/plugins/gift/assets/favicon.ico')}}" />
    <meta name="description" content="سباق الخير - أهدِ من تحب" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>سباق الخير</title>
    <link rel="preload" href="{{ URL::asset('vendor/core/plugins/gift/assets/fonts/Cairo-Regular.woff2')}}" as="font" type="font/woff2" crossorigin />
    <link rel="preload" href="{{ URL::asset('vendor/core/plugins/gift/assets/fonts/Cairo-Bold.woff2')}}" as="font" type="font/woff2" crossorigin />
    <link rel="modulepreload" href="{{ URL::asset('vendor/core/plugins/gift/scripts/page_1.js')}}" />
    <link rel="modulepreload" href="{{ URL::asset('vendor/core/plugins/gift/scripts/page_2.js')}}" />
    <link rel="modulepreload" href="{{ URL::asset('vendor/core/plugins/gift/scripts/page_3.js')}}" />
    <link rel="modulepreload" href="{{ URL::asset('vendor/core/plugins/gift/scripts/page_4.js')}}" />
    <link rel="modulepreload" href="{{ URL::asset('vendor/core/plugins/gift/scripts/utils.js')}}" />
    <link rel="modulepreload" href="{{ URL::asset('vendor/core/plugins/gift/scripts/validation.js')}}" />
  </head>
  <body>
    <main>
      <div class="top-layer" style="opacity: 0"></div>

      <section class="page page-1">
        <div class="header">
          <div class="logo-container">
            <div class="logos slide-in-bck-center">
              <img
                src="{{ URL::asset('vendor/core/plugins/gift/assets/svg/logo_wide.svg')}}"
                width="140"
                height="auto"
                alt="جمعية احياء التراث الاسلامي"
                aria-label="جمعية احياء التراث الاسلامي"
              />
              <img src="{{ URL::asset('vendor/core/plugins/gift/assets/svg/logo.svg')}}" width="110" height="auto" alt="سباق الخير" aria-label="سباق الخير" />
            </div>
            <p class="logo-text">أهدِ من تحب</p>
          </div>
        </div>

        <div class="content">
          <div class="page-1-bg"></div>
          <div class="page-1-txt">
            <p class="top">سباق الخير - أهدِ من تحب</p>
            <p class="middle">إهداء خاص لمن تحب في شهر الخير والعطاء شارك الأجر، وأهدِ هدية معنوية تحمل الأثر!</p>
            <p class="bottom">املأ البيانات التالية لإرسال إهدائك</p>
          </div>

          <div class="gift-container">
            <img
              class="gift-small-start"
              src="{{ URL::asset('vendor/core/plugins/gift/assets/svg/gift_small.svg')}}"
              width="96"
              height="100"
              alt="gift"
              aria-label="gift"
            />
            <div class="gift-large-container">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="130"
                height="147"
                fill="none"
                aria-hidden="true"
                class="gift-tag"
                style="rotate: 120deg; scale: 0"
                viewBox="0 0 140 157"
              >
                <path
                  fill="#fff"
                  stroke="#F2B714"
                  d="m63.685 74.048-12.113-3.19a10.57 10.57 0 0 1-6.523-4.996 10.58 10.58 0 0 1-1.029-8.15l3.317-11.985a10.6 10.6 0 0 1 4.94-6.386l57.948-33.456c4.808-2.776 10.98-1.124 13.757 3.686l9.355 16.203c2.776 4.807 1.123 10.98-3.686 13.757L71.727 72.973a10.58 10.58 0 0 1-8.042 1.075ZM49.337 56.903a5.61 5.61 0 0 0-2.052 7.658 5.61 5.61 0 0 0 7.657 2.05 5.61 5.61 0 0 0 2.051-7.655 5.61 5.61 0 0 0-7.656-2.053Z"
                ></path>
                <path
                  fill="#F2B714"
                  d="M47.278 63.603 44.27 65.34a.81.81 0 0 0-.298 1.108l.021.036a.81.81 0 0 0 1.108.297l3.009-1.737a.81.81 0 0 0 .297-1.108l-.02-.036a.81.81 0 0 0-1.109-.297"
                ></path>
                <path stroke="#585858" stroke-dasharray="2 2" d="M123.968 27.895 67.32 60.6"></path>
                <path stroke="#F2B714" stroke-width="2" d="M44.5 66c-23 16-46 47-42.5 90"></path>
                <text
                  id="gift-tag-text"
                  x="94"
                  y="80"
                  fill="#0A4F2B"
                  font-family="Cairo"
                  font-size="10"
                  lengthAdjust="spacingAndGlyphs"
                  textLength="70"
                  transform="rotate(-30)"
                >
                  .
                </text>
              </svg>
              <img
                class="gift-ribbon"
                src="{{ URL::asset('vendor/core/plugins/gift/assets/svg/gift_ribbon.svg')}}"
                width="154"
                height="102"
                alt="gift"
                aria-label="gift"
              />
              <img
                class="gift-large"
                src="{{ URL::asset('vendor/core/plugins/gift/assets/svg/gift_large.svg')}}"
                width="154"
                height="122"
                alt="gift"
                aria-label="gift"
              />
            </div>
            <img
              class="gift-small-end"
              src="{{ URL::asset('vendor/core/plugins/gift/assets/svg/gift_small.svg')}}"
              width="96"
              height="100"
              alt="gift"
              aria-label="gift"
            />
          </div>

          <!----------- MESSAGE TEMPLATES ----------->
          <div class="slider" style="display: none">
            @php $i = 1; @endphp
            @foreach($certs as $cert)
              <button class="template-btn {{$i==1 ? 'selected':''}}" data-index="{{$cert->id}}">
                <img
                  src="{{ RvMedia::getImageUrl($cert->image, null, false, RvMedia::getDefaultImage()) }}"
                  width="200"
                  height="300"
                  alt="{{$cert->name}}"
                  aria-label="{{$cert->name}}"
                />
              </button>
              @php $i++; @endphp
            @endforeach
          </div>

          <div class="msg-bubble" style="display: none">
            <img
              class="msg-bubble-top"
              src="{{ URL::asset('vendor/core/plugins/gift/assets/svg/hand_msg_quote_top.webp')}}"
              width="450"
              height="140"
              alt="msg-bubble"
              aria-hidden="true"
            />
            <img
              class="msg-bubble-bottom"
              src="{{ URL::asset('vendor/core/plugins/gift/assets/svg/hand_msg_quote_bottom.webp')}}"
              width="450"
              height="140"
              alt="msg-bubble"
              aria-hidden="true"
            />
          </div>
        </div>

        <div class="inputs slide-in-blurred-bottom">
          <div class="page-1-inputs inputs-wrapper">
            <div class="input-container">
              <input
                class="input-elements"
                id="project-name"
                name="project-name"
                type="text"
                placeholder="اسم المشروع الذي تبرعت له"
                aria-label="اسم المشروع الذي تبرعت له"
                autocomplete="off"
              />
            </div>
            <div class="input-container">
              <input
                class="input-elements"
                id="email"
                name="email"
                type="email"
                dir="ltr"
                placeholder="بريدك الإلكتروني"
                aria-label="بريدك الإلكتروني"
                autocomplete="off"
              />
            </div>
          </div>

          <div class="page-2-inputs inputs-wrapper" style="display: none">
            <div class="input-container with-arrow">
              <input
                class="input-elements"
                id="donor-name"
                type="text"
                placeholder="اسم مُرسل الإهداء ( باللغة العربية )"
                aria-label="اسم مُرسل الإهداء ( باللغة العربية )"
                autocomplete="off"
                maxlength="20"
              />
            </div>
            <div class="input-container">
              <input
                class="input-elements"
                id="donor-phone"
                type="tel"
                placeholder="965xxxxxxxx رقم المُرسل"
                aria-label="رقم مُرسل الإهداء"
                autocomplete="off"
              />
            </div>
          </div>

          <div class="page-3-inputs inputs-wrapper" style="display: none">
            <div class="input-container with-arrow">
              <input
                class="input-elements"
                id="recipient-name"
                type="text"
                placeholder="اسم مُتلقي الإهداء ( باللغة العربية )"
                aria-label="اسم مُتلقي الإهداء ( باللغة العربية )"
                autocomplete="off"
                maxlength="20"
              />
            </div>
            <div class="input-container">
              <input
                class="input-elements"
                id="recipient-phone"
                type="tel"
                placeholder="965xxxxxxxx رقم المُتلقي"
                aria-label="رقم مُتلقي الإهداء"
                autocomplete="off"
              />
            </div>
          </div>

          <!-- not an input -->
          <div class="page-4-inputs inputs-wrapper" style="display: none">
            <div class="choose-template">
              <span>اختر قالب الهدية</span>
            </div>
          </div>

          <!-- not an input -->
          <div class="page-5-inputs inputs-wrapper" style="display: none">
            <div class="done-msg">
              <p class="title">تقبل الله منك </p>
              <p class="desc">تم استلام بيانات الإهداء بنجاح سيتم تزويدك بنسخة من بطاقة الإهداء، وإرسال نسخة إلى المُهدى إليه عبر الواتساب قريبًا بإذن الله</p>
            </div>
          </div>
        </div>

        <div class="controls">
          <div class="controls-buttons" style="grid-template-columns: 0fr 1fr; gap: 0">
            <div class="button-container" style="min-width: 0">
              <button id="back-button" class="button-elements back-button" style="display: none" aria-label="رجوع">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="28"
                  height="24"
                  fill="none"
                  aria-hidden="true"
                  class="back-button-icon"
                >
                  <path stroke="#fff" stroke-width="2" d="m0 12 25.942.059M15 23l11-11L15 1"></path>
                </svg>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="32"
                  height="32"
                  fill="#fff"
                  class="back-button-home-icon"
                  style="display: none"
                  viewBox="0 -960 960 960"
                >
                  <path
                    d="M160-200v-360q0-19 8.5-36t23.5-28l240-180q21-16 48-16t48 16l240 180q15 11 23.5 28t8.5 36v360q0 33-23.5 56.5T720-120H600q-17 0-28.5-11.5T560-160v-200q0-17-11.5-28.5T520-400h-80q-17 0-28.5 11.5T400-360v200q0 17-11.5 28.5T360-120H240q-33 0-56.5-23.5T160-200"
                  ></path>
                </svg>
              </button>
            </div>
            <div class="button-container">
              <button id="next-button" class="button-elements next-button">
                <span>البدأ</span>
              </button>
            </div>
          </div>
          <div class="page-indicators-container">
            <div id="second-page-indicator" class="page-indicator active" style="transform: translateY(30px)"></div>
            <div id="third-page-indicator" class="page-indicator" style="transform: translateY(30px)"></div>
            <div id="fourth-page-indicator" class="page-indicator" style="transform: translateY(30px)"></div>
          </div>
        </div>

        <img
          class="carrying-hand"
          style="top: 75%; inset-inline-end: 0; rotate: 90deg; transform: translate(-100%, 50%)"
          width="740"
          height="147"
          src="{{ URL::asset('vendor/core/plugins/gift/assets/svg/carrying_hand.svg')}}"
          alt="carrying-hand"
          aria-hidden="true"
        />

        <img
          class="hand-with-pen"
          style="top: 50%; inset-inline-start: 0; transform: translate(100%, -50%)"
          width="525"
          height="151"
          src="{{ URL::asset('vendor/core/plugins/gift/assets/svg/hand_with_pen.svg')}}"
          alt="hand-with-pen"
          aria-hidden="true"
        />
      </section>
    </main>
    <script>
      var routePost = "{{ route('public.send.gift') }}";
      var token = "{{ csrf_token() }}";
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ URL::asset('vendor/core/plugins/gift/scripts/main.js')}}" type="module"></script>
    
  </body>
</html>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>写真部 写真館</title>
    <!-- layout -->
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!-- script -->
    <script src="/js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="/js/jquery.inview.min.js" type="text/javascript"></script>
    <script>
        $(function () {
            $('#menu-close').click(function () {
                $('aside').toggleClass('aside-close');
            });

            $('.sp-menu .button').click(function () {
                $('aside').toggleClass('open');
                $('.sp-menu-mask').toggleClass('open');
            });

            $('.sp-menu-mask').click(function () {
                $('aside').toggleClass('open');
                $('.sp-menu-mask').toggleClass('open');
            });
            //
            // $('.ph-box.fadeIn').each(function () {
            //     $(this).one('inview', function () {
            //         $(this).addClass('scrollIn');
            //         if ($(this).find('img.lazy').length) {
            //             let src = $(this).find('img.lazy').data('original');
            //             $(this).find('img').attr('src', src);
            //         }
            //     });
            // });
            //
            // let main = $('main'), emptyCells = [], i;
            //
            // for (i = 0; i < main.find('.ph-box').length; i++) {
            //     emptyCells.push($('<div></div>', {class: 'ph-box is-empty'}));
            // }
            // main.append(emptyCells);
        });
    </script>
</head>

<body>
    <aside>
        <div class="menu-title">
            <h1>写真部</h1>
            <h1 class="small">写真館</h1>
        </div>
        <div class="search">
            <input type="text" name="keyword" placeholder="キーワードで写真を検索">
        </div>
        <div class="menu">
            <ul>
                <li>
                    <a href="/">
                        <i class="fas fa-fw fa-home"></i>
                        <span>ホーム</span>
                    </a>
                </li>
                <li>
                    <a href="https://support.nova-systems.jp" target="_blank" rel="noreferrer">
                        <i class="fas fa-fw fa-envelope"></i>
                        <span>お問い合わせ</span>
                    </a>
                </li>
                <li>
                    <a href="https://nova-systems.jp" target="_blank" rel="noreferrer">
                        <i class="fas fa-fw fa-school"></i>
                        <span>運営サイト</span>
                    </a>
                </li>
                <li>
                    <a id="menu-close">
                        <span>閉じる</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main>
        <div class="sp-menu">
            <div class="button">
                <i class="fas fa-bars"></i>
            </div>
            <div class="title">
                <h1>写真部 写真館</h1>
            </div>
        </div>
        <div class="sp-menu-mask"></div>
        <div class="content">
            <h1>404 NotFound</h1>
            <p>お探しのページは見つかりませんでした。</p>
        </div>
    </main>
</body>

</html>
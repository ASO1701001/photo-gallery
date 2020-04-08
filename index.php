<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="description" content="写真ギャラリー">
    <meta name="keywords" content="写真,写真ギャラリー,写真部">
    <title>写真部 写真館</title>
    <!-- layout -->
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="/css/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="/css/lightbox.min.css">
    <!-- script -->
    <script src="/js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="/js/jquery.inview.min.js" type="text/javascript"></script>
    <script src="/js/toastr.min.js" type="text/javascript"></script>
    <script src="/js/lightbox.min.js" type="text/javascript"></script>
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

            $('.search input[name=keyword]').keypress(function (e) {
                let keyword = $(this).val();
                if (e.keyCode === 13 && keyword !== "") {
                    location.href = '/search/' + keyword;
                    return false;
                }
            });

            let main = $('main'), emptyCells = [], i;

            for (i = 0; i < main.find('.ph-box').length; i++) {
                emptyCells.push($('<div></div>', { class: 'ph-box is-empty' }));
            }
            main.append(emptyCells);

            main.scroll(function () {
                let value = $(this).scrollTop();

                if (value >= 150) {
                    $('.scroll-top').fadeIn();
                } else {
                    $('.scroll-top').fadeOut();
                }
            });

            $('.scroll-top').click(function () {
                $('main').animate({
                    scrollTop: 0
                }, 500);
            });

            $('.ph-box.fade-in').each(function () {
                $(this).one('inview', function () {
                    $(this).addClass('scroll-in');
                    if ($(this).find('img.lazy').length) {
                        let src = $(this).find('img.lazy').data('original');
                        $(this).find('img').attr('src', src);
                    }
                });
            });
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
                <i class="fas fa-fw fa-bars"></i>
            </div>
            <div class="title">
                <h1>写真部 写真館</h1>
            </div>
        </div>
        <div class="sp-menu-mask"></div>
        <div class="scroll-top">
            <i class="fas fa-fw fa-angle-up"></i>
        </div>
        <?php
        require_once 'libs/PhotoManager.php';

        if (isset($_GET['keyword'])) {
            $photo_list = PhotoManager::getSearch($_GET['keyword']);
            if (count($photo_list) == 0) {
                ?>
                <script>
                    toastr.warning('入力されたキーワードに関する写真は見つかりませんでした', {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
                </script>
                <?php
                $photo_list = PhotoManager::getAllImage();
            }
        } else {
            $photo_list = PhotoManager::getAllImage();
        }

        foreach ($photo_list as $row) : ?>
        <div class="ph-box fade-in <?php if ($row === end($photo_list)) echo 'last'; ?>">
            <a href="<?php echo $row['full_image']; ?>" data-lightbox="photo-gallery" data-title="<?php echo $row['title']; ?>">
                <img class="lazy" data-original="<?php echo $row['thumbnail_image']; ?>" src="/img/loader/circle.svg" alt="<?php echo $row['title']; ?>">
                <div class="hover-mask">
                    <p><?php echo $row['title']; ?></p>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </main>
</body>

</html>
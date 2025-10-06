<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Introduction about Hiang</title>
    <link rel="stylesheet" href="{{ asset('css/intro.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epunda+Slab:ital,wght@0,300..900;1,300..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
</head>
<body>
    <div class="top-banner">
        <p class="top-banner-text" style="font-size:120%"><b>Cùng tìm hiểu về Hiang nhé</b></p>
    </div>

    <header class="header">
        <!-- Logo -->
        <div class="header-logo" title="ShopHiang">
            <a><img src="{{ asset('images/logo.png') }}" alt="ShopHiang Logo" style="width: 150px; height:100px;"></a>
        </div>
   </header>

    <div class="header-menu" >
        <nav class="header-nav">
            <a href="{{ url('/') }}" class="header-nav-link" title="Trang chủ" ><b>Trang chủ</b></a>
            <a href="{{ route('menuProducts') }}" class="header-nav-link" title="Menu"><b>Danh sách các món</b></a>
            <a href="#" style="text-decoration: none; color: #007bff"><b>Giới thiệu</b></a>
        </nav>
    </div>


    <div class="main-content">
    <div class="content-row left">
        <div class="content">
            <h2>Câu chuyện Hiang Food</h2>
            <p>Mọi chuyện bắt đầu vào năm 2023, 
            khi một nhóm bạn trẻ đam mê ẩm thực ngồi lại trong một căn bếp nhỏ, b
            àn bạc về cách mang hương vị ngon miệng, 
            chất lượng và tiện lợi đến với mọi người. 
            Từ những nồi súp thơm lừng, 
            những chiếc bánh mì giòn tan và các món ăn nhanh đơn giản nhưng tỉ mỉ, 
            từng món được thử nghiệm nhiều lần để tạo ra hương vị vừa quen thuộc,
            vừa hiện đại. Niềm vui từ những phản hồi tích cực của bạn bè và người thân đã tiếp thêm động lực, 
            đưa Hiang Food từ ý tưởng trở thành quán ăn đầu tiên mở cửa, và dần dần phát triển thành thương hiệu đồ ăn nhanh được nhiều người yêu thích. 
            Mỗi bữa ăn tại Hiang Food không chỉ là đồ ăn nhanh – mà là tâm huyết, 
            là câu chuyện về sự tận tâm và tình yêu với ẩm thực.</p>
        </div>
        </div>
    </div>

    <div class="content-row right">
        <div class="content">
            <h2>Thân thiện với khách hàng</h2>
            <p>Hiang Food luôn đặt sự chân thành và chu đáo lên hàng đầu trong mỗi trải nghiệm với khách hàng. 
                Từ cách chào hỏi, 
                phục vụ đến việc lắng nghe và tiếp nhận mọi phản hồi, 
                chúng tôi mong muốn mỗi khách ghé thăm đều cảm thấy được trân trọng, 
                an tâm và thoải mái. 
                Mỗi món ăn được trao đến tay khách không chỉ là bữa ăn nhanh – mà còn là minh chứng cho sự tận tâm, 
                niềm vui và tình cảm mà Hiang Food muốn gửi gắm trong từng chi tiết nhỏ.</p>
        </div>
    </div>

    <div class="content-row left">
        <div class="content content-3" >
            <h2>Chất lượng sản phẩm</h2>
            <p>Mỗi món ăn tại Hiang Food đều được chuẩn bị kỹ lưỡng từ nguyên liệu tươi ngon, 
                đảm bảo an toàn vệ sinh thực phẩm, 
                đến quy trình chế biến chuyên nghiệp để giữ trọn hương vị và chất lượng. 
                Chúng tôi luôn cam kết mang đến cho khách hàng những bữa ăn không chỉ nhanh gọn mà còn đầy dinh dưỡng, 
                thơm ngon và nhất quán trong từng phần. 
                Chất lượng không chỉ là tiêu chuẩn – mà là lời hứa của Hiang Food đối với mọi khách hàng.</p>
        </div>
    </div>

    <div class="content-row right">
        <div class="content">
            <h2>Tầm nhìn tương lai</h2>
            <p>Hiang Food hướng tới trở thành thương hiệu đồ ăn nhanh được yêu thích trên toàn quốc, nơi mỗi khách hàng đều có thể tìm thấy sự tiện lợi, hương vị ngon miệng và trải nghiệm thân thiện, chu đáo. Chúng tôi không ngừng cải tiến thực đơn, mở rộng dịch vụ và nâng cao chất lượng phục vụ, đồng thời duy trì cam kết về sự chân thành và tận tâm trong từng món ăn. Tầm nhìn của Hiang Food là xây dựng một cộng đồng khách hàng gắn kết, nơi mỗi bữa ăn nhanh đều mang lại niềm vui, sự hài lòng và cảm giác gần gũi như ở nhà.</p>
        </div>
    </div>
</div>
<div class="footer-bottom">
        <p>Theo dõi chúng tôi:</p>
        <div class="social-icons">
            <a href="#"><img src="{{ asset('images/tiktok.png') }}" alt="tiktok-icon" title="TikTok"></a>
            <a href="#"><img src="{{ asset('images/instagram.png') }}" alt="instagram-icon" title="Instagram"></a>
            <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="facebook-icon" title="Facebook"></a>
            <a href="#"><img src="{{ asset('images/youtube.png') }}" alt="youtube-icon" title="YouTube"></a>
        </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const contents = document.querySelectorAll('.content');

    function checkScroll() {
        const triggerBottom = window.innerHeight * 0.95;

        contents.forEach(content => {
            const boxTop = content.getBoundingClientRect().top;

            if (boxTop < triggerBottom) {
                content.classList.add('show');
            }
        });
    }

    window.addEventListener('scroll', checkScroll);
    checkScroll(); // gọi 1 lần khi load trang
});
</script>


</body>
</html>
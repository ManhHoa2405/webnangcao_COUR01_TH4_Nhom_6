# webnangcao_COUR01_TH4_Nhom_6
Được Phát Triển Bởi:
-- NGUYỄN ĐĂNG HANH VÀ NGUYỄN MẠNH HÒA --
##Mô Tả Ứng Dụng :
+ Ứng dụng web bán đồ ăn nhanh cho phép người dùng xem các món ăn, thêm vào giỏ hàng, đặt món trực tuyến và thanh toán nhanh chóng.
+ Quản trị viên có thể dễ dàng quản lý người dùng, sản phẩm, danh mục món ăn, đơn hàng và doanh thu.
+ Hệ thống được xây dựng trên nền tảng web hiện đại, đảm bảo tốc độ truy cập nhanh, bảo mật và thân thiện với người dùng.

##Mục Đích
- Quản lý thông tin người dùng (khách hàng và quản trị viên).
- Quản lý thông tin sản phẩm (món ăn, đồ uống).
- Quản lý danh mục món ăn giúp dễ dàng phân loại sản phẩm.
- Quản lý giỏ hàng và đơn hàng.
- Tích hợp giao diện thân thiện, dễ thao tác, phù hợp trên mọi thiết bị.
- Hiển thị dữ liệu nhanh chóng, chính xác và trực quan.

##Công Nghệ Sử Dụng
#Dự án được phát triển bằng Laravel Framework (phiên bản mới nhất), kết hợp với các công nghệ hiện đại nhằm tăng hiệu suất và dễ bảo trì:
- Ngôn ngữ lập trình: PHP 8.x
- Cơ sở dữ liệu: MySQL
- Thư viện JavaScript: jQuery, Bootstrap
- Giao diện quản trị: AdminLTE 3.x
- Ngôn ngữ giao diện: HTML, CSS, JavaScript
- Mô hình và mẫu thiết kế:
- Laravel Repository Pattern
- Laravel Service Pattern
- Laravel Events & Listeners

##Quá Trình Phát Triển Phần Mềm : Các Giai Đoạn Chính:
- Phân tích (Analysis): Thu thập yêu cầu, phân tích nghiệp vụ đặt món và quản lý đơn hàng
- Thiết kế (Design): Thiết kế cơ sở dữ liệu, sơ đồ chức năng (user – admin) và giao diện website.
- Cài đặt (Implementation): Lập trình các chức năng chính như đăng nhập, menu, giỏ hàng, thanh toán, quản lý sản phẩm.
- Kiểm thử (Testing): Kiểm tra các chức năng CRUD, xác thực đăng nhập và đặt hàng.
- Triển khai (Deployment): Chạy ứng dụng trên máy chủ cục bộ hoặc triển khai thực tế

##Sơ Đồ Chức Năng (Sơ Đồ Thuật Toán) : 
•	A[Người dùng truy cập hệ thống] --> B[Chọn hành động];
•	B --> C{Loại người dùng};

•	%% --- Khách hàng (User) ---
•	C --> D[Khách: Xem trang chủ];
•	D --> D1[Hiển thị giới thiệu cửa hàng và món ăn nổi bật];

•	C --> E[Khách: Xem menu];
•	E --> E1[Hiển thị danh sách món ăn];
•	E1 --> E2[Chọn món xem chi tiết];
•	E2 --> E3[Hiển thị thông tin chi tiết sản phẩm];
•	E3 --> E4[Chọn số lượng, thêm vào giỏ hàng];

•	C --> F[Khách: Đăng ký / Đăng nhập];
•	F --> F1{Tình trạng tài khoản};
•	F1 --> F2[Đăng ký: Nhập thông tin, lưu vào CSDL];
•	F1 --> F3[Đăng nhập: Nhập thông tin, xác thực với CSDL];
•	F3 --> F4{Kết quả đăng nhập};
•	F4 --> F5[Thành công: Chuyển đến trang chủ];
•	F4 --> F6[Thất bại: Hiển thị thông báo lỗi];

•	C --> G[Khách: Quản lý giỏ hàng];
•	G --> G1[Hiển thị danh sách sản phẩm trong giỏ];
•	G1 --> G2[Chọn thanh toán];
•	G2 --> G3[Chọn hình thức thanh toán];
•	G3 --> G4[Xác nhận và gửi đơn hàng];
•	G4 --> G5[Hiển thị thông báo đặt hàng thành công];

•	C --> H[Khách: Quản lý thông tin cá nhân];
•	H --> H1[Xem/Sửa thông tin cá nhân];
•	H1 --> H2[Lưu thay đổi vào CSDL];

•	%% --- Quản trị viên (Admin) ---
•	C --> I[Admin: Đăng nhập vào hệ thống];
•	I --> I1[Xác thực thông tin tài khoản admin];
•	I1 --> I2{Kết quả đăng nhập};
•	I2 --> I3[Thành công: Truy cập trang quản trị];
•	I2 --> I4[Thất bại: Thông báo lỗi];

•	I3 --> J[Admin: Quản lý sản phẩm];
•	J --> J1[Hiển thị danh sách sản phẩm];
•	J1 --> J2[Thêm/sửa/xóa sản phẩm];

•	I3 --> K[Admin: Quản lý danh mục];
•	K --> K1[Thêm/sửa/xóa danh mục];

•	I3 --> L[Admin: Quản lý người dùng];
•	L --> L1[Xem danh sách người dùng];
•	L --> L2[Sửa / Xóa thông tin người dùng];

•	I3 --> M[Admin: Quản lý đơn hàng];
•	M --> M1[Xem danh sách đơn hàng];
•	M1 --> M2[Xem chi tiết đơn hàng];
•	M1 --> M3[Cập nhật trạng thái đơn hàng];

•	%% --- Kết thúc ---
•	G5 --> Z[Kết thúc quy trình];
•	N2 --> Z;
-	Yêu cầu phi chức năng :
•	Dễ sử dụng : Giao diện trực quan, dễ nhìn.
•	Bảo mật : Áp dụng các biện pháp xác thực và phân quyền tiêu chuẩn từ Laravel.

##Chu Trình Triển Khai
- Cài đặt môi trường :
    composer create-project laravel/laravel fastfood-shop
    cd fastfood-shop
- Tạo database :
    CREATE DATABASE fastfood;
- Cấu hình .env :
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=fastfood
    DB_USERNAME=root
    DB_PASSWORD=
- Cài đặt dependencies :
    composer require jeroennoten/laravel-adminlte
    composer require laravel/ui
- Chạy migrations :
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
- Deploy lên server :
    php artisan serve
##Lưu Ý Về Cải Tiến Cấu Trúc

- Áp dụng Repository Pattern: Tách biệt lớp truy cập dữ liệu khỏi Controller.
- Service Layer: Chứa logic nghiệp vụ, giúp code dễ bảo trì và mở rộng.
- Request Validation: Đảm bảo dữ liệu đầu vào hợp lệ.
- API Resources: Chuẩn hóa dữ liệu trả về từ API.
- Events & Listeners: Xử lý các tác vụ phụ như gửi email, thông báo khi đặt hàng.

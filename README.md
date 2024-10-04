Cài đặt JWT (JSON Web Token)
Cài đặt package tymon/jwt-auth để thực hiện xác thực API:
composer require tymon/jwt-auth

Xuất bản cấu hình:
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

Cấu hình JWT:
Mở file config/jwt.php và điều chỉnh các cấu hình nếu cần thiết.

Tạo khóa JWT:
php artisan jwt:secret
kiểm tra file .env có dòng JWT_SECRET="" chưa

test post user
127.0.0.1:8000/api/users
{
    "user_name": "Jin Huynh",
    "email": "jin@example.com",
    "password": "password123",
    "avatar": "link_to_avatar",
    "gender": "nam",
    "role": 100,
    "google_id": "google_id_if_any",
    "access_token": "access_token_if_any",
    "provider": "local"
}

test put user
127.0.0.1:8000/api/users/{$user_id}
{
    "user_name": "Jin bede",
    "email": "jinbede@example.com",
    "gender": "nu"
}

test delete user
127.0.0.1:8000/api/users/{$user_id}

login google
get
http://127.0.0.1:8000/api/login/google

login local
check role admin là 100
get
127.0.0.1:8000/api/login
{
    "email": "jin@example.com",
    "password": "password123"
}
lấy Token
header
key: Authorization
value: Bearer (token đã lấy)

profile 
put 
127.0.0.1:8000/api/profile/update
{
    "user_name": "Jin Dep Trai",
    "avatar": "link avatar",
    "gender": "nam" chỉ có 'nam' or 'nu'
}

change-password
put
127.0.0.1:8000/api/profile/change-password
{
    "current_password": "mật khẩu hiện tại",
    "new_password": "mật khẩu mới",
    "new_password_confirmation": "nhập lại mật khẩu mới"
}

logout 
post
127.0.0.1:8000/api/logout

packages
post
127.0.0.1:8000/api/packages
{
    "name": "tên gói",
    "duration": "365", // thời gian gói vd: 1 ngày, 7 ngày, 30 ngày, 1 năm
    "price": "giá tiền của gói"
}

packages
put
127.0.0.1:8000/api/packages/{$packages_id}
{
    "name": "sửa tên gói",
    "duration": "365", sửa thời gian
    "price": "sửa giá tiền của gói"
}

packages
delete
127.0.0.1:8000/api/packages/{$packages_id}

package/purchase
post
127.0.0.1:8000/api/package/purchase
{
    "package_id": 1, // id gói
    "voucher_name   ": "lấy tên voucher để giảm giá" // bỏ voucher đã tạo vào
}
sau khi send thì có đường dẫn thanh toán hoá đơn

thẻ test
Ngân hàng	NCB
Số thẻ	9704198526191432198
Tên chủ thẻ	NGUYEN VAN A
Ngày phát hành	07/15
Mật khẩu OTP	123456

status invoices success thì gửi gửi mail hoá đơn cho khách hàng

voucher-types
post
12.0.0.1:8000/api/voucher-types
{
    "name": "Discount 20%", // tên giảm giá
    "discount": 20, // % giảm giá
    "customer_usage_limit": 1, // số lượt sử dụng
    "discount_type": "percentage", // percentage loại giảm giá phần trăm, fixed loại giảm giá theo số tiền cố định
    "min_spend": 50000 // giảm tối thiểu 50000
}
voucher-types
delete
12.0.0.1:8000/api/voucher-types/{voucher_types_id}




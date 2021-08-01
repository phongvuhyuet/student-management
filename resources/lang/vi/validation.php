<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
     */

    'accepted'             => ':attribute cần phải được chấp thuận.',
    'active_url'           => ':attribute là đường dẫn không có hiệu lực.',
    'after'                => ':attribute phải là một ngày sau ngày :date.',
    'after_or_equal'       => ':attribute phải là một ngày từ :date trở đi.',
    'alpha'                => ':attribute chỉ được chứa chữ cái.',
    'alpha_dash'           => ':attribute chỉ được chứa chữ cái, chữ số, dấu gạch "-" và dấu gạch dưới "_".',
    'alpha_num'            => ':attribute chỉ được chứa chữ cái và chữ số.',
    'array'                => ':attribute phải là một tập hợp.',
    'before'               => ':attribute phải là một ngày trước ngày :date.',
    'before_or_equal'      => ':attribute phải là một ngày từ :date trở về trước.',
    'between'              => [
        'numeric' => ':attribute phải nằm trong khoảng :min và :max.',
        'file'    => 'Kích thước :attribute phải nằm trong khoảng :min và :max kB.',
        'string'  => ':attribute phải có ít nhất :min và nhiều nhất :max kí tự.',
        'array'   => ':attribute phải có ít nhất :min và nhiều nhất :max phần tử.',
    ],
    'boolean'              => ':attribute phải nhận giá trị đúng hoặc sai.',
    'confirmed'            => ':attribute xác nhận không trùng khớp.',
    'current_password'     => 'Mật khẩu không chính xác.',
    'date'                 => ':attribute không là ngày hợp lệ.',
    'date_equals'          => ':attribute phải là :date.',
    'date_format'          => ':attribute không đúng với định dạng :format.',
    'different'            => ':attribute và :other phải khác nhau.',
    'digits'               => ':attribute phải là :digits đơn vị.',
    'digits_between'       => ':attribute phải gồm ít nhất :min và nhiều nhất :max đơn vị.',
    'dimensions'           => ':attribute không có kích thước ảnh hợp lệ.',
    'distinct'             => ':attribute có một giá trị bị trùng.',
    'email'                => ':attribute phải là một địa chỉ email hợp lệ.',
    'ends_with'            => ':attribute phải cố kết thúc là: :values.',
    'exists'               => ':attribute đã chọn không hợp lệ.',
    'file'                 => ':attribute phải là một file.',
    'filled'               => ':attribute không được để trống.',
    'gt'                   => [
        'numeric' => ':attribute phải lớn hơn :value.',
        'file'    => 'Kích thước :attribute tối thiểu là :value kB.',
        'string'  => ':attribute phải có nhiều hơn :value kí tự.',
        'array'   => ':attribute phải có nhiều hơn :value phần tử.',
    ],
    'gte'                  => [
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'file'    => 'Kích thước :attribute phải lớn hơn hoặc bằng :value kB.',
        'string'  => ':attribute phải có ít nhất :value kí tự.',
        'array'   => ':attribute phải có ít nhất :value items.',
    ],
    'image'                => ':attribute phải là ảnh.',
    'in'                   => ':attribute đã chọn không hợp lệ.',
    'in_array'             => ':attribute không tồn tại trong :other.',
    'integer'              => ':attribute phải là số nguyên.',
    'ip'                   => ':attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4'                 => ':attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6'                 => ':attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json'                 => ':attribute phải là một chuỗi JSON hợp lệ.',
    'lt'                   => [
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'file'    => 'Kích thước :attribute phải nhỏ hơn :value kB.',
        'string'  => ':attribute phải ít hơn :value  kí tự.',
        'array'   => ':attribute có ít hơn :value phần tử.',
    ],
    'lte'                  => [
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'file'    => 'Kích thước :attribute tối đa chỉ là :value kB.',
        'string'  => ':attribute chỉ được có nhiều nhất :value kí tự.',
        'array'   => ':attribute chỉ được có nhiều nhất :value phần tử.',
    ],
    'max'                  => [
        'numeric' => ':attribute không được lớn hơn :max.',
        'file'    => 'kích thước :attribute không được lớn hơn :max kB.',
        'string'  => ':attribute không được có nhiều hơn :max kí tự.',
        'array'   => ':attribute không được có nhiều hơn :max phần tử.',
    ],
    'mimes'                => ':attribute phải là file kiểu: :values.',
    'mimetypes'            => ':attribute phải là file kiểu: :values.',
    'min'                  => [
        'numeric' => ':attribute không được nhỏ hơn :min.',
        'file'    => 'Kích thước :attribute không được nhỏ hơn :min kB.',
        'string'  => ':attribute không được có ít hơn :min kí tự.',
        'array'   => ':attribute không được có ít hơn :min phần tử.',
    ],
    'multiple_of'          => ':attribute phải có nhiều giá trị :value.',
    'not_in'               => ':attribute đã chọn không hợp lệ.',
    'not_regex'            => 'Định dang :attribute không hợp lệ.',
    'numeric'              => ':attribute phải là số.',
    'password'             => 'Mật khẩu không chính xác.',
    'present'              => ':attribute phải hiện hữu.',
    'regex'                => 'Định dạng :attribute không hợp lệ.',
    'required'             => ':attribute được yêu cầu.',
    'required_if'          => ':attribute được yêu cầu khi :other là :value.',
    'required_unless'      => ':attribute được yêu cầu nếu :other không là :values.',
    'required_with'        => ':attribute được yêu cầu khi :values hiện hữu.',
    'required_with_all'    => ':attribute được yêu cầu khi tất cả :values hiện hữu.',
    'required_without'     => ':attribute được yêu cầu khi :values không hiện hữu.',
    'required_without_all' => ':attribute được yêu cầu khi tất cả :values không hiện hữu.',
    'prohibited'           => ':attribute bị cấm.',
    'prohibited_if'        => ':attribute bị cấm khi :other là :value.',
    'prohibited_unless'    => ':attribute bị cấm trừ nếu :other không là :values.',
    'same'                 => ':attribute phải trùng với :other.',
    'size'                 => [
        'numeric' => ':attribute phải là :size.',
        'file'    => 'Kích thước :attribute phải là :size kilobytes.',
        'string'  => ':attribute phải có :size kí tự.',
        'array'   => ':attribute phải có :size phần tử.',
    ],
    'starts_with'          => ':attribute phải bắt đầu bằng một trong những giá trị sau: :values.',
    'string'               => ':attribute phải là một xâu.',
    'timezone'             => ':attribute phải là một múi giờ hợp lệ.',
    'unique'               => ':attribute đã tồn tại.',
    'uploaded'             => ':attribute tải lên thất bại.',
    'url'                  => ':attribute phải là một đường dẫn hợp lệ.',
    'uuid'                 => ':attribute phải là định danh hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
     */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
     */

    'attributes'           => [],

];


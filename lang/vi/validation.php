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

    'accepted' => 'Mục này phải được chấp nhận.',
    'accepted_if' => 'Mục này phải được chấp nhận khi :other là :value.',
    'active_url' => 'Mục này không phải là một URL hợp lệ.',
    'after' => 'Mục này phải là một ngày sau :date.',
    'after_or_equal' => 'Mục này phải là một ngày sau hoặc bằng :date.',
    'alpha' => 'Mục này chỉ được chứa chữ cái.',
    'alpha_dash' => 'Mục này chỉ được chứa chữ cái, số, dấu gạch ngang và gạch dưới.',
    'alpha_num' => 'Mục này chỉ được chứa chữ cái và số.',
    'array' => 'Mục này phải là một mảng.',
    'before' => 'Mục này phải là một ngày trước :date.',
    'before_or_equal' => 'Mục này phải là một ngày trước hoặc bằng :date.',
    'between' => [
        'numeric' => 'Mục này phải nằm trong khoảng :min đến :max.',
        'file' => 'Mục này phải có kích thước từ :min đến :max kilobyte.',
        'string' => 'Mục này phải có từ :min đến :max ký tự.',
        'array' => 'Mục này phải có từ :min đến :max phần tử.',
    ],
    'boolean' => 'Mục này phải là true hoặc false.',
    'confirmed' => 'Mục này không khớp với trường xác nhận.',
    'current_password' => 'Mật khẩu không chính xác.',
    'date' => 'Mục này không phải là một ngày hợp lệ.',
    'date_equals' => 'Mục này phải là một ngày bằng :date.',
    'date_format' => 'Mục này không khớp với định dạng :format.',
    'declined' => 'Mục này phải bị từ chối.',
    'declined_if' => 'Mục này phải bị từ chối khi :other là :value.',
    'different' => 'Mục này và :other phải khác nhau.',
    'digits' => 'Mục này phải là :digits chữ số.',
    'digits_between' => 'Mục này phải có độ dài từ :min đến :max chữ số.',
    'dimensions' => 'Mục này có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Mục này có giá trị trùng lặp.',
    'email' => 'Mục này phải là một địa chỉ email hợp lệ.',
    'ends_with' => 'Mục này phải kết thúc bằng một trong những giá trị sau: :values.',
    'enum' => 'Giá trị đã chọn cho :attribute không hợp lệ.',
    'exists' => 'Giá trị đã chọn cho :attribute không hợp lệ.',
    'file' => 'Mục này phải là một tập tin.',
    'filled' => 'Mục này phải có giá trị.',
    'gt' => [
        'numeric' => 'Mục này phải lớn hơn :value.',
        'file' => 'Mục này phải lớn hơn :value kilobyte.',
        'string' => 'Mục này phải lớn hơn :value ký tự.',
        'array' => 'Mục này phải có nhiều hơn :value phần tử.',
    ],
    'gte' => [
        'numeric' => 'Mục này phải lớn hơn hoặc bằng :value.',
        'file' => 'Mục này phải lớn hơn hoặc bằng :value kilobyte.',
        'string' => 'Mục này phải lớn hơn hoặc bằng :value ký tự.',
        'array' => 'Mục này phải có :value phần tử hoặc nhiều hơn.',
    ],
    'image' => 'Mục này phải là một hình ảnh.',
    'in' => 'Giá trị đã chọn cho :attribute không hợp lệ.',
    'in_array' => 'Mục này không tồn tại trong :other.',
    'integer' => 'Mục này phải là một số nguyên.',
    'ip' => 'Mục này phải là một địa chỉ IP hợp lệ.',
    'ipv4' => 'Mục này phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6' => 'Mục này phải là một địa chỉ IPv6 hợp lệ.',
    'json' => 'Mục này phải là một chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => 'Mục này phải nhỏ hơn :value.',
        'file' => 'Mục này phải nhỏ hơn :value kilobyte.',
        'string' => 'Mục này phải nhỏ hơn :value ký tự.',
        'array' => 'Mục này phải có ít hơn :value phần tử.',
    ],
    'lte' => [
        'numeric' => 'Mục này phải nhỏ hơn hoặc bằng :value.',
        'file' => 'Mục này phải nhỏ hơn hoặc bằng :value kilobyte.',
        'string' => 'Mục này phải nhỏ hơn hoặc bằng :value ký tự.',
        'array' => 'Mục này không được có nhiều hơn :value phần tử.',
    ],
    'mac_address' => 'Mục này phải là một địa chỉ MAC hợp lệ.',
    'max' => [
        'numeric' => 'Mục này không được lớn hơn :max.',
        'file' => 'Mục này không được lớn hơn :max kilobyte.',
        'string' => 'Mục này không được lớn hơn :max ký tự.',
        'array' => 'Mục này không được có nhiều hơn :max phần tử.',
    ],
    'mimes' => 'Mục này phải là một tập tin có định dạng: :values.',
    'mimetypes' => 'Mục này phải là một tập tin có định dạng: :values.',
    'min' => [
        'numeric' => 'Mục này phải tối thiểu là :min.',
        'file' => 'Mục này phải tối thiểu là :min kilobyte.',
        'string' => 'Mục này phải tối thiểu là :min ký tự.',
        'array' => 'Mục này phải có tối thiểu :min phần tử.',
    ],
    'multiple_of' => 'Mục này phải là bội số của :value.',
    'not_in' => 'Giá trị đã chọn cho :attribute không hợp lệ.',
    'not_regex' => 'Định dạng :attribute không hợp lệ.',
    'numeric' => 'Mục này phải là một số.',
    'password' => 'Mật khẩu không chính xác.',
    'present' => 'Mục này phải được cung cấp.',
    'prohibited' => 'Mục này bị cấm.',
    'prohibited_if' => 'Mục này bị cấm khi :other là :value.',
    'prohibited_unless' => 'Mục này bị cấm trừ khi :other là :values.',
    'prohibits' => 'Mục này cấm :other có mặt.',
    'regex' => 'Định dạng :attribute không hợp lệ.',
    'required' => 'Mục này là bắt buộc.',
    'required_array_keys' => 'Mục này phải chứa các khóa :values.',
    'required_if' => 'Mục này là bắt buộc khi :other là :value.',
    'required_unless' => 'Mục này là bắt buộc trừ khi :other là :values.',
    'required_with' => 'Mục này là bắt buộc khi có :values.',
    'required_with_all' => 'Mục này là bắt buộc khi có :values.',
    'required_without' => 'Mục này là bắt buộc khi không có :values.',
    'required_without_all' => 'Mục này là bắt buộc khi không có bất kỳ :values nào.',
    'same' => 'Mục này và :other phải khớp.',
    'size' => [
        'numeric' => 'Mục này phải là :size.',
        'file' => 'Mục này phải là :size kilobyte.',
        'string' => 'Mục này phải là :size ký tự.',
        'array' => 'Mục này phải chứa :size phần tử.',
    ],
    'starts_with' => 'Mục này phải bắt đầu bằng một trong những giá trị sau: :values.',
    'string' => 'Mục này phải là một chuỗi.',
    'timezone' => 'Mục này phải là một múi giờ hợp lệ.',
    'unique' => 'Giá trị đã chọn cho :attribute đã được sử dụng.',
    'uploaded' => 'Mục này tải lên thất bại.',
    'url' => 'Định dạng :attribute không hợp lệ.',
    'uuid' => 'Mục này phải là một chuỗi UUID hợp lệ.',

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

    'custom' => [
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

    'attributes' => [],

];

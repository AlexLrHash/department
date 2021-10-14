<?php


return [
    'user' => [
      'name' => [
          'required' => 'Имя обязательно',
          'max'      => 'Максимальное количество символов должно не превышать 255',
          'min'      => 'Минимальное количество символов должно быть больше 6',
      ],
      'email' => [
          'required'     => 'Почта обязательна',
          'unique'       => 'Почта уже юзается',
          'email'        => 'Почта имеет неверный формат',
          'invalid_code' => 'Передайте верификационый код'
      ],
      'password' => [
          'required'  => 'Пароль обязателен',
          'confirmed' => 'Подтверждение пароля обязательно'
      ],
      'phone' => [
          'required' => 'Передайте телефон',
          'regex'    => 'Неверный формат телефона(Прим: 80(25)8965390)'
      ],
      'role' => [
          'in'       => 'Передана несуществующая роль',
          'required' => 'Передайте роль',
      ],
    ],
    'disciplines' => [
        'number_of_practices' => [
            'required' => 'Передайте количество практик',
            'value'    => 'Неверное число'
        ],
        'number_of_labs' => [
            'required' => 'Передайте количество лаб',
            'value'    => "Неверное число"
        ],
        'name' => [
            'required' => 'Передайте имя',
            'string'   => 'Имя должно быть строкой'
        ],
        'department_id' => [
            'required' => 'Передайте отделение',
            'exists'   => 'Передано несуществующее отделение'
        ],
        'description' => [
            'required' => 'Передайте описание',
            'string'   => 'Описание должно быть строкой'
        ]
    ]
];

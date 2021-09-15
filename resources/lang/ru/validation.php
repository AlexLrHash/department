<?php


return [
  'user' => [
      'name' => [
          'required' => 'Имя обязательно',
          'max'      => 'Максимальное количество символов должно не превышать 255',
          'min'      => 'Минимальное количество символов должно быть больше 6',
      ],
      'email' => [
          'required' => 'Почта обязательна',
          'unique'   => 'Почта уже юзается',
          'email'    => 'Почта имеет неверный формат',

      ],
      'password' => [
          'required'  => 'Пароль обязателен',
          'confirmed' => 'Подтверждение пароля обязательно'
      ]
  ]
];

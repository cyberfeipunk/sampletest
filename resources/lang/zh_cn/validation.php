<?php
return [
  'required'=>' :attribute 不能为空!',
  'confirmed' => ' :attribute 确认失败! ',
  'numeric' => ':attribute 必须为数字！',
  'min' => [
    'string' => ' :attribute 长度不能小于 :min 个字符!',
  ],
  'attributes' => [
    'email'=>'邮箱',
    'password'=>'密码',
    'name'=>'名称',
  ],
];

<?php

namespace App\Enum;

enum TaskStatusEnum
{
  const pending = '0';

  const review = '1';

  const change_requested = '2';

  const approved = '3';
}

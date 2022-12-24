<?php

declare(strict_types=1);

namespace mss\Core\Domain\User;

enum Action: int
{
    case use_app = 0x0001; // Входить в программу
    case login_site = 0x0002; // Входить на сайт
    case edit_unit = 0x0004; // Редактировать ТС
    case edit_zone = 0x0008; // Редактировать объекты
    case edit_route = 0x0010; // Редактировать маршруты
    case view_assets = 0x0020; // Доступ к активам
    case view_report = 0x0040; // Доступ к отчетам
    case load_track = 0x0080; // Загружать треки
    case grant_data = 0x0100; // Передавать данные другим пользователям
    case view_track = 0x0200; // Показывать треки
    case edit_x5_fake_temp = 0x0400; // Редактировать настройки генератора температуры
    case view_x5_fake_temp = 0x0800; // Показывать сгенерированную температуру
    case view_simple_fake_temp = 0x1000; // Показывать сгенерированную температуру Simple
    case edit_fake_temp_registry = 0x2000; // Редактировать FakeTempRegistry
    case create_reusable_route = 0x4000; // Создавать неодноразовые маршруты по объектам
    case edit_custom_reports = 0x8000; // Редактировать пользовательские отчеты
    case lock_engine = 0x10000; // Блокировать двигатель
}

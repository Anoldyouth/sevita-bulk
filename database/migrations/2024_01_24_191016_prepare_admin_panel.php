<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<SQL
            insert into settings (id, key, display_name, value, details, type, "order", "group")
            values  (3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site'),
                    (5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin'),
                    (8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
                    (9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
                    (1, 'site.title', 'Site Title', 'Sevita', '', 'text', 1, 'Site'),
                    (2, 'site.description', 'Site Description', 'Сайт Sevita', '', 'text', 2, 'Site'),
                    (4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', null, '', 'text', 4, 'Site'),
                    (6, 'admin.title', 'Admin Title', 'Sevita Admin Panel', '', 'text', 1, 'Admin'),
                    (7, 'admin.description', 'Admin Description', 'Административная панель Sevita', '', 'text', 2, 'Admin'),
                    (10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', null, '', 'text', 1, 'Admin'),
                    (13, 'site.vkontakte', 'VKontakte', null, null, 'text', 6, 'Site'),
                    (14, 'site.telegram', 'Telegram', null, null, 'text', 7, 'Site');
        SQL);

        DB::statement(<<<SQL
            insert into menus (id, name, created_at, updated_at)
            values  (1, 'admin', '2024-01-27 12:04:22', '2024-01-27 12:04:22');
        SQL);

        DB::statement(<<<SQL
            insert into menu_items (id, menu_id, title, url, target, icon_class, color, parent_id, "order", created_at, updated_at, route, parameters)
            values  (6, 1, 'Menu Builder', '', '_self', 'voyager-list', null, 5, 1, '2024-01-27 12:04:22', '2024-01-27 13:30:27', 'voyager.menus.index', null),
                    (7, 1, 'Database', '', '_self', 'voyager-data', null, 5, 2, '2024-01-27 12:04:22', '2024-01-27 13:30:27', 'voyager.database.index', null),
                    (8, 1, 'Compass', '', '_self', 'voyager-compass', null, 5, 3, '2024-01-27 12:04:22', '2024-01-27 13:30:27', 'voyager.compass.index', null),
                    (9, 1, 'BREAD', '', '_self', 'voyager-bread', null, 5, 4, '2024-01-27 12:04:22', '2024-01-27 13:30:27', 'voyager.bread.index', null),
                    (12, 1, 'Список парфюма', '', '_self', 'voyager-list', null, null, 1, '2024-01-27 12:31:40', '2024-01-27 13:30:29', 'voyager.perfumes.index', null),
                    (11, 1, 'Импорты парфюма', '', '_self', 'voyager-list-add', null, null, 2, '2024-01-27 12:25:44', '2024-01-27 13:30:38', 'voyager.perfumes-imports.index', null),
                    (13, 1, 'Ошибки импортов', '', '_self', 'voyager-info-circled', null, null, 3, '2024-01-27 12:33:31', '2024-01-27 13:30:42', 'voyager.perfumes-import-errors.index', null),
                    (1, 1, 'Dashboard', '', '_self', 'voyager-boat', null, null, 4, '2024-01-27 12:04:22', '2024-01-27 13:30:42', 'voyager.dashboard', null),
                    (4, 1, 'Roles', '', '_self', 'voyager-lock', null, null, 5, '2024-01-27 12:04:22', '2024-01-27 13:30:42', 'voyager.roles.index', null),
                    (3, 1, 'Users', '', '_self', 'voyager-person', null, null, 6, '2024-01-27 12:04:22', '2024-01-27 13:30:42', 'voyager.users.index', null),
                    (2, 1, 'Media', '', '_self', 'voyager-images', null, null, 7, '2024-01-27 12:04:22', '2024-01-27 13:30:42', 'voyager.media.index', null),
                    (5, 1, 'Tools', '', '_self', 'voyager-tools', null, null, 8, '2024-01-27 12:04:22', '2024-01-27 13:30:42', null, null),
                    (10, 1, 'Settings', '', '_self', 'voyager-settings', null, null, 9, '2024-01-27 12:04:22', '2024-01-27 13:30:42', 'voyager.settings.index', null);
        SQL);

        DB::insert(<<<SQL
            insert into data_types (id, name, slug, display_name_singular, display_name_plural, icon, model_name, description, generate_permissions, created_at, updated_at, server_side, controller, policy_name, details)
            values  (1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\Voyager\Models\User', '', true, '2024-01-27 12:04:22', '2024-01-27 12:04:22', 0, 'TCG\Voyager\Http\Controllers\VoyagerUserController', 'TCG\Voyager\Policies\UserPolicy', null),
                    (2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\Voyager\Models\Menu', '', true, '2024-01-27 12:04:22', '2024-01-27 12:04:22', 0, '', null, null),
                    (3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\Voyager\Models\Role', '', true, '2024-01-27 12:04:22', '2024-01-27 12:04:22', 0, 'TCG\Voyager\Http\Controllers\VoyagerRoleController', null, null),
                    (5, 'perfumes_imports', 'perfumes-imports', 'Импорт парфюма', 'Импорты парфюма', 'voyager-list-add', 'App\Models\PerfumesImport', null, true, '2024-01-27 12:25:44', '2024-01-27 12:25:44', 0, 'App\Http\Controllers\PerfumesImportController', null, '{"order_column":"created_at","order_display_column":"created_at","order_direction":"desc","default_search_key":null}'),
                    (6, 'perfumes', 'perfumes', 'Парфюм', 'Список парфюма', 'voyager-list', 'App\Models\Perfume', null, true, '2024-01-27 12:31:40', '2024-01-27 12:31:40', 0, null, null, '{"order_column":"id","order_display_column":null,"order_direction":"asc","default_search_key":null}'),
                    (7, 'perfumes_import_errors', 'perfumes-import-errors', 'Ошибка импорта', 'Ошибки импортов', 'voyager-info-circled', 'App\Models\PerfumesImportError', null, true, '2024-01-27 12:33:31', '2024-01-27 12:34:41', 0, null, null, '{"order_column":"import_id","order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}');
        SQL);

        DB::statement(<<<SQL
            insert into data_rows (id, data_type_id, field, type, display_name, required, browse, read, edit, add, delete, details, "order")
            values  (1, 1, 'id', 'number', 'ID', true, false, false, false, false, false, null, 1),
                    (2, 1, 'name', 'text', 'Name', true, true, true, true, true, true, null, 2),
                    (3, 1, 'email', 'text', 'Email', true, true, true, true, true, true, null, 3),
                    (4, 1, 'password', 'password', 'Password', true, false, false, true, true, false, null, 4),
                    (5, 1, 'remember_token', 'text', 'Remember Token', false, false, false, false, false, false, null, 5),
                    (6, 1, 'created_at', 'timestamp', 'Created At', false, true, true, false, false, false, null, 6),
                    (7, 1, 'updated_at', 'timestamp', 'Updated At', false, false, false, false, false, false, null, 7),
                    (8, 1, 'avatar', 'image', 'Avatar', false, true, true, true, true, true, null, 8),
                    (9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', false, true, true, true, true, false, '{"model":"TCG\\\\Voyager\\\\Models\\\\Role","table":"roles","type":"belongsTo","column":"role_id","key":"id","label":"display_name","pivot_table":"roles","pivot":0}', 10),
                    (10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', false, true, true, true, true, false, '{"model":"TCG\\\\Voyager\\\\Models\\\\Role","table":"roles","type":"belongsToMany","column":"id","key":"id","label":"display_name","pivot_table":"user_roles","pivot":"1","taggable":"0"}', 11),
                    (11, 1, 'settings', 'hidden', 'Settings', false, false, false, false, false, false, null, 12),
                    (12, 2, 'id', 'number', 'ID', true, false, false, false, false, false, null, 1),
                    (13, 2, 'name', 'text', 'Name', true, true, true, true, true, true, null, 2),
                    (14, 2, 'created_at', 'timestamp', 'Created At', false, false, false, false, false, false, null, 3),
                    (15, 2, 'updated_at', 'timestamp', 'Updated At', false, false, false, false, false, false, null, 4),
                    (16, 3, 'id', 'number', 'ID', true, false, false, false, false, false, null, 1),
                    (17, 3, 'name', 'text', 'Name', true, true, true, true, true, true, null, 2),
                    (18, 3, 'created_at', 'timestamp', 'Created At', false, false, false, false, false, false, null, 3),
                    (19, 3, 'updated_at', 'timestamp', 'Updated At', false, false, false, false, false, false, null, 4),
                    (20, 3, 'display_name', 'text', 'Display Name', true, true, true, true, true, true, null, 5),
                    (21, 1, 'role_id', 'text', 'Role', true, true, true, true, true, true, null, 9),
                    (22, 5, 'id', 'text', '№', true, true, false, false, false, false, '{}', 1),
                    (23, 5, 'status', 'text', 'Статус', true, true, false, false, false, false, '{}', 2),
                    (24, 5, 'file', 'text', 'Файл', true, true, false, false, false, false, '{}', 3),
                    (25, 5, 'chunks_count', 'text', 'Число частей', false, true, false, false, false, false, '{}', 4),
                    (26, 5, 'chunks_finished', 'text', 'Частей завершено', true, true, false, false, false, false, '{}', 5),
                    (27, 5, 'message', 'text', 'Сообщение', false, true, false, false, false, false, '{}', 6),
                    (28, 5, 'created_at', 'timestamp', 'Создано', false, true, false, false, false, false, '{}', 7),
                    (30, 6, 'id', 'text', 'Код', true, true, true, true, true, true, '{"validation":{"rule":"required|integer|unique:perfumes","messages":{"required":"\u041f\u043e\u043b\u0435 \"\u041a\u043e\u0434\" \u043e\u0431\u044f\u0437\u0430\u0442\u0435\u043b\u044c\u043d\u043e \u0434\u043b\u044f \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u0438\u044f","integer":"\u041f\u043e\u043b\u0435 \"\u041a\u043e\u0434\" \u0434\u043e\u043b\u0436\u043d\u043e \u0431\u044b\u0442\u044c \u0446\u0435\u043b\u043e\u0447\u0438\u0441\u043b\u0435\u043d\u043d\u044b\u043c","unique":"\u041f\u043e\u043b\u0435 \"\u041a\u043e\u0434\" \u0434\u043e\u043b\u0436\u043d\u043e \u0431\u044b\u0442\u044c \u0443\u043d\u0438\u043a\u0430\u043b\u044c\u043d\u044b\u043c"}}}', 1),
                    (33, 6, 'created_at', 'timestamp', 'Создано', false, true, false, false, false, false, '{}', 4),
                    (34, 6, 'updated_at', 'timestamp', 'Изменено', false, false, false, false, false, false, '{}', 5),
                    (35, 7, 'id', 'text', 'Код', true, false, false, false, false, false, '{}', 1),
                    (36, 7, 'import_id', 'text', 'Код импорта', true, true, false, false, false, false, '{}', 3),
                    (37, 7, 'row_num', 'text', 'Строка', true, true, false, false, false, false, '{}', 4),
                    (38, 7, 'message', 'text', 'Сообщение', true, true, false, false, false, false, '{}', 5),
                    (39, 7, 'created_at', 'timestamp', 'Создано', false, false, false, false, false, false, '{}', 6),
                    (40, 7, 'updated_at', 'timestamp', 'Изменено', false, false, false, false, false, false, '{}', 7),
                    (41, 7, 'perfumes_import_error_belongsto_perfumes_import_relationship', 'relationship', 'Файл', false, true, false, false, false, false, '{"model":"App\\\\Models\\\\PerfumesImport","table":"perfumes_imports","type":"belongsTo","column":"import_id","key":"file","label":"file","pivot_table":"migrations","pivot":"0","taggable":"0"}', 2),
                    (31, 6, 'name', 'text', 'Наименование', true, true, true, true, true, true, '{"validation":{"rule":"required|string|unique:perfumes","messages":{"required":"\u041f\u043e\u043b\u0435 \"\u041d\u0430\u0438\u043c\u0435\u043d\u043e\u0432\u0430\u043d\u0438\u0435\" \u043e\u0431\u044f\u0437\u0430\u0442\u0435\u043b\u044c\u043d\u043e \u0434\u043b\u044f \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u0438\u044f","string":"\u041f\u043e\u043b\u0435 \"\u041d\u0430\u0438\u043c\u0435\u043d\u043e\u0432\u0430\u043d\u0438\u0435\" \u0434\u043e\u043b\u0436\u043d\u043e \u0431\u044b\u0442\u044c \u0441\u0442\u0440\u043e\u043a\u043e\u0439","unique":"\u041f\u043e\u043b\u0435 \"\u041d\u0430\u0438\u043c\u0435\u043d\u043e\u0432\u0430\u043d\u0438\u0435\" \u0434\u043e\u043b\u0436\u043d\u043e \u0431\u044b\u0442\u044c \u0443\u043d\u0438\u043a\u0430\u043b\u044c\u043d\u044b\u043c"}}}', 2),
                    (32, 6, 'price', 'text', 'Цена', true, true, true, true, true, true, '{"validation":{"rule":"required|numeric","messages":{"required":"\u041f\u043e\u043b\u0435 \"\u0426\u0435\u043d\u0430\" \u043e\u0431\u044f\u0437\u0430\u0442\u0435\u043b\u044c\u043d\u043e \u0434\u043b\u044f \u0437\u0430\u043f\u043e\u043b\u043d\u0435\u043d\u0438\u044f","numeric":"\u041f\u043e\u043b\u0435 \"\u0426\u0435\u043d\u0430\" \u0434\u043e\u043b\u0436\u043d\u043e \u0431\u044b\u0442\u044c \u0447\u0438\u0441\u043b\u043e\u043c"}}}', 3),
                    (29, 5, 'updated_at', 'timestamp', 'Изменено', false, false, false, false, false, false, '{}', 8);
        SQL);

        DB::statement(<<<SQL
            insert into roles (id, name, display_name, created_at, updated_at)
            values  (1, 'admin', 'Administrator', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (2, 'user', 'Normal User', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (3, 'employee', 'employee', '2024-01-27 12:41:29', '2024-01-27 12:41:29');
        SQL);

        DB::statement(<<<SQL
            insert into users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, avatar, role_id, settings)
            values  (1, 'Admin', 'admin@admin.com', null, '$2y$12\$it0of2MtlPgOCOUxdDmrTej5eMXeZ.D6iozLZmTJUPRMhBO6dYi3q', 'B8qBZFxAYZRZdzCC8MWhsJjtGIYJlak0JElHBKQsFndNgscyGwBbzJmPGc0W', '2024-01-27 12:02:46', '2024-01-27 12:02:46', 'users/default.png', 1, null);
        SQL);

        DB::statement(<<<SQL
            insert into permissions (id, key, table_name, created_at, updated_at)
            values  (1, 'browse_admin', null, '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (2, 'browse_bread', null, '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (3, 'browse_database', null, '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (4, 'browse_media', null, '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (5, 'browse_compass', null, '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (6, 'browse_menus', 'menus', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (7, 'read_menus', 'menus', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (8, 'edit_menus', 'menus', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (9, 'add_menus', 'menus', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (10, 'delete_menus', 'menus', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (11, 'browse_roles', 'roles', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (12, 'read_roles', 'roles', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (13, 'edit_roles', 'roles', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (14, 'add_roles', 'roles', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (15, 'delete_roles', 'roles', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (16, 'browse_users', 'users', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (17, 'read_users', 'users', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (18, 'edit_users', 'users', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (19, 'add_users', 'users', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (20, 'delete_users', 'users', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (21, 'browse_settings', 'settings', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (22, 'read_settings', 'settings', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (23, 'edit_settings', 'settings', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (24, 'add_settings', 'settings', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (25, 'delete_settings', 'settings', '2024-01-27 12:04:22', '2024-01-27 12:04:22'),
                    (26, 'browse_perfumes_imports', 'perfumes_imports', '2024-01-27 12:25:44', '2024-01-27 12:25:44'),
                    (27, 'read_perfumes_imports', 'perfumes_imports', '2024-01-27 12:25:44', '2024-01-27 12:25:44'),
                    (28, 'edit_perfumes_imports', 'perfumes_imports', '2024-01-27 12:25:44', '2024-01-27 12:25:44'),
                    (29, 'add_perfumes_imports', 'perfumes_imports', '2024-01-27 12:25:44', '2024-01-27 12:25:44'),
                    (30, 'delete_perfumes_imports', 'perfumes_imports', '2024-01-27 12:25:44', '2024-01-27 12:25:44'),
                    (31, 'browse_perfumes', 'perfumes', '2024-01-27 12:31:40', '2024-01-27 12:31:40'),
                    (32, 'read_perfumes', 'perfumes', '2024-01-27 12:31:40', '2024-01-27 12:31:40'),
                    (33, 'edit_perfumes', 'perfumes', '2024-01-27 12:31:40', '2024-01-27 12:31:40'),
                    (34, 'add_perfumes', 'perfumes', '2024-01-27 12:31:40', '2024-01-27 12:31:40'),
                    (35, 'delete_perfumes', 'perfumes', '2024-01-27 12:31:40', '2024-01-27 12:31:40'),
                    (36, 'browse_perfumes_import_errors', 'perfumes_import_errors', '2024-01-27 12:33:31', '2024-01-27 12:33:31'),
                    (37, 'read_perfumes_import_errors', 'perfumes_import_errors', '2024-01-27 12:33:31', '2024-01-27 12:33:31'),
                    (38, 'edit_perfumes_import_errors', 'perfumes_import_errors', '2024-01-27 12:33:31', '2024-01-27 12:33:31'),
                    (39, 'add_perfumes_import_errors', 'perfumes_import_errors', '2024-01-27 12:33:31', '2024-01-27 12:33:31'),
                    (40, 'delete_perfumes_import_errors', 'perfumes_import_errors', '2024-01-27 12:33:31', '2024-01-27 12:33:31');
        SQL);

        DB::statement(<<<SQL
            insert into permission_role (permission_id, role_id)
            values  (1, 1),
                    (2, 1),
                    (3, 1),
                    (4, 1),
                    (5, 1),
                    (6, 1),
                    (7, 1),
                    (8, 1),
                    (9, 1),
                    (10, 1),
                    (11, 1),
                    (12, 1),
                    (13, 1),
                    (14, 1),
                    (15, 1),
                    (16, 1),
                    (17, 1),
                    (18, 1),
                    (19, 1),
                    (20, 1),
                    (21, 1),
                    (22, 1),
                    (23, 1),
                    (24, 1),
                    (25, 1),
                    (26, 1),
                    (27, 1),
                    (28, 1),
                    (29, 1),
                    (30, 1),
                    (31, 1),
                    (32, 1),
                    (33, 1),
                    (34, 1),
                    (35, 1),
                    (36, 1),
                    (37, 1),
                    (38, 1),
                    (39, 1),
                    (40, 1),
                    (1, 3),
                    (6, 3),
                    (21, 3),
                    (22, 3),
                    (23, 3),
                    (26, 3),
                    (31, 3),
                    (32, 3),
                    (33, 3),
                    (34, 3),
                    (35, 3),
                    (36, 3);
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

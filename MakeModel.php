<?php

namespace Core\Console\Commands;

use Core\Console\Command;

class MakeModel extends Command
{
    public function signature(): string
    {
        return 'make:model';
    }

    public function description(): string
    {
        return 'Create a new model       (e.g. make:model User --timestamps)';
    }

    public function handle(array $args): void
    {
        $name = $args[0] ?? null;

        if (!$name) {
            $this->error("Please provide a model name.");
            $this->line("Usage: php lite make:model User");
            $this->line("       php lite make:model Admin/User");
            $this->line("       php lite make:model User --timestamps");
            return;
        }

        $timestamps = in_array('--timestamps', $args);
        $parsed     = $this->parseName($name);
        $class      = $parsed['class'];
        $subPath    = $parsed['subpath'];

        $namespace = 'App\\Models';
        if ($subPath) {
            $namespace .= '\\' . str_replace('/', '\\', $subPath);
        }

        $path = BASE_PATH . '/app/Models/'
            . ($subPath ? $subPath . '/' : '')
            . $class . '.php';

        $table = $this->toTableName($class);

        $timestampsLine = $timestamps
            ? "\n    protected bool \$timestamps = true;\n"
            : '';

        $content = <<<PHP
        <?php

        namespace {$namespace};

        use Core\Database\Model;

        class {$class} extends Model
        {
            protected static string \$table      = '{$table}';
            protected static string \$primaryKey = 'id';
            protected static bool   \$timestamps = false;

            protected static array \$fillable = [];

            protected static array \$guarded = ['id'];
        }
        PHP;

        $this->createFile($path, $content);
    }

    // ─────────────────────────────────────────────
    // No pluralization — the table name is just the
    // snake_case form of the class name, as-is.
    //
    // User           → user
    // Category       → category
    // Categories     → categories   (whatever you name the class)
    // FarmerProfile  → farmer_profile
    // ─────────────────────────────────────────────
    protected function toTableName(string $class): string
    {
        // PascalCase / camelCase → snake_case
        $snake = preg_replace('/(?<!^)[A-Z]/', '_$0', $class);

        return strtolower($snake);
    }
}
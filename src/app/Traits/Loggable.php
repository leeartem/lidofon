<?php

declare(strict_types=1);

namespace App\Traits;

use App\Enums\ActionEnum;
use App\Models\History;
use Illuminate\Database\Eloquent\Model;

trait Loggable
{
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            self::logAction($model, ActionEnum::CREATE);
        });

        static::softDeleted(function ($model) {
            self::logAction($model, ActionEnum::SOFT_DELETE);
        });

        static::forceDeleting(function ($model) {
            self::logAction($model, ActionEnum::FORCE_DELETE);
        });

        static::updating(function ($model) {
            self::logAction($model, ActionEnum::UPDATE);
        });

        static::restoring(function ($model) {
            self::logAction($model, ActionEnum::RESTORE);
        });
    }

    protected static function logAction(Model $model, ActionEnum $action): void
    {
        History::create([
            'model_id' => $model->id,
            'model_name' => $model::class,
            'before' => $model->getOriginal(),
            'after' => $model->getAttributes(),
            'action' => $action->value,
            ...self::getData($model, $action),
        ]);
    }

    private static function getData(Model $model, ActionEnum $action): array
    {
        return match ($action) {
            ActionEnum::CREATE => ['before' => null],
            ActionEnum::SOFT_DELETE => [
                'before' => [
                    ...$model->getAttributes(),
                    'deleted_at' => null,
                ],
            ],
            ActionEnum::FORCE_DELETE => ['after' => null],
            ActionEnum::RESTORE => [
                'after' => [
                    ...$model->getAttributes(),
                    'deleted_at' => null,
                ],
            ],
            default => []
        };
    }
}

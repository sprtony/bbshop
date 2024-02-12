<?php

namespace App\Filament\Resources;

use Illuminate\Database\Eloquent\{Builder, Collection};

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use App\Filament\Resources\PermissionResource\Pages;
use App\Models\{Permission, Role};

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $modelLabel = 'Permiso';
    protected static ?string $pluralModelLabel = 'Permisos';

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';
    protected static ?string $navigationGroup = 'Control de accesos';

    public static function form(Form $form): Form
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        return $form
            ->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nombre')
                        ->required(),
                    Forms\Components\Select::make('roles')
                        ->multiple()
                        ->label('Roles')
                        ->relationship('roles', 'name')
                        ->preload(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('models')
                    ->form(function () {
                        $commands = new \Althinect\FilamentSpatieRolesPermissions\Commands\Permission();
                        $models = $commands->getAllModels();

                        return array_map(function (\ReflectionClass $model) {
                            return Forms\Components\Checkbox::make($model->getShortName());
                        }, $models);
                    })
                    ->query(function (Builder $query, array $data) {
                        return $query->where(function (Builder $query) use ($data) {
                            foreach ($data as $key => $value) {
                                if ($value) {
                                    $query->orWhere('name', 'like', eval('return \'%\'.$key;'));
                                }
                            }
                        });
                    }),
            ])->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                Tables\Actions\BulkAction::make('Agregar a Rol')
                    ->action(function (Collection $records, array $data): void {
                        foreach ($records as $record) {
                            $record->roles()->sync($data['role']);
                            $record->save();
                        }
                    })
                    ->form([
                        Forms\Components\Select::make('role')
                            ->label('Rol')
                            ->options(Role::query()->pluck('name', 'id'))
                            ->required(),
                    ])->deselectRecordsAfterCompletion(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePermissions::route('/'),
        ];
    }
}

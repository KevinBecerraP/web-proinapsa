<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Miembro')
                    ->description('Datos del integrante del equipo')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nombre Completo')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ej: Juan Pérez García')
                                    ->prefixIcon('heroicon-o-user')
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('position')
                                    ->label('Cargo')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ej: Director General')
                                    ->prefixIcon('heroicon-o-briefcase')
                                    ->columnSpan(1),

                                Forms\Components\Textarea::make('description')
                                    ->label('Descripción')
                                    ->required()
                                    ->rows(3)
                                    ->maxLength(200)
                                    ->placeholder('Describe la experiencia y habilidades del miembro del equipo...')
                                    ->helperText('Breve descripción profesional (máximo 200 caracteres)')
                                    ->columnSpanFull(),
                            ]),
                    ])->collapsible(),

                Forms\Components\Section::make('Fotografía')
                    ->description('Imagen del miembro del equipo')
                    ->icon('heroicon-o-camera')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('force')
                            ->imageResizeTargetWidth('393')
                            ->imageResizeTargetHeight('390')
                            ->imagePreviewHeight('150')
                            ->panelLayout('integrated')
                            ->directory('team')
                            ->maxSize(2048)
                            ->downloadable()
                            ->openable()
                            ->helperText('📐 Dimensión final: 393 × 390 px - La imagen se redimensionará automáticamente sin recortar. Formatos: JPG, PNG. Máximo: 2MB')
                            ->columnSpanFull(),
                    ])->collapsible(),

                Forms\Components\Section::make('Estado')
                    ->description('Visibilidad del miembro en el sitio web')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Toggle::make('status')
                            ->label('Estado')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Activa o desactiva la visualización de este miembro en el sitio web')
                            ->columnSpanFull(),
                    ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}

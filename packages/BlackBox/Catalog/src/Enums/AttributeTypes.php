<?php

namespace BlackBox\Catalog\Enums;

use Filament\Support\Contracts\HasLabel;

enum AttributeTypes: string implements HasLabel
{
    case Text = 'Text';
    case LongText = 'LongText';
    case Option = 'Option';
    case Color = 'Color';
    case File = 'File';
    case Imagen = 'Imagen';
    case Boolean = 'Boolean';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Text => 'Texto',
            self::LongText => 'Texto con formato',
            self::Option => 'Lista de opciones',
            self::Color => 'Color',
            self::File => 'Archivo',
            self::Imagen => 'Imagen',
            self::Boolean => 'Switch (si / no)',
        };
    }
}

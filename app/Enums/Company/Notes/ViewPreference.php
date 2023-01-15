<?php declare(strict_types=1);

namespace App\Enums\Company\Notes;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Attributes\Description;

final class ViewPreference extends Enum
{
    #[Description('Publicly display notes on the company page')]
    public const PUBLIC  = 0;
    #[Description('Only display notes on the company page to you')]
    public const PRIVATE = 1;
}

<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ModuleItemType extends Enum
{
    const Content = 0;
    const Video = 1;
    const Document = 2;
    const Question = 3;
}

@php
/** @var \Gavoronok30\LaravelGeneratorConfigurable\Data\GeneratorServiceDataFilterField[] $filterFields */
@endphp
namespace App\Domain\{{ $entityName }};

use App\Contract\Core\FilterInterface;
use App\Helpers\StringConvertHelper;
use Illuminate\Http\Request;
@foreach($useCommonForFilter as $use)
use {{ $use }};
@endforeach

/**
 * Class {{ $entityName }}Filter
 * {{ '@' }}package App\Domain\{{ $entityName }}
 */
class {{ $entityName }}Filter implements FilterInterface
{
@foreach($filterFields as $field)
    /**
     * {{ '@' }}var {{ $field->getType() }}|null
     */
    private ?{{ $field->getType() }} ${{ $field->getName() }} = null;
@endforeach

    /**
     * {{ '@' }}param Request $request
     * {{ '@' }}return self
     */
    public static function fromRequest(Request $request): self
    {
        $filter = collect($request->input('filter'));

        return (new self())
@foreach($filterFields as $index => $field)
@php
$last = ($index + 1) == count($filterFields);
@endphp
@switch($field->getType())
@case('int')
            ->set{{ \Illuminate\Support\Str::ucfirst($field->getName()) }}(StringConvertHelper::toInteger($filter->get('{{ $field->getName() }}')))@if($last);@endif
@break
@case('float')
            ->set{{ \Illuminate\Support\Str::ucfirst($field->getName()) }}(StringConvertHelper::toFloat($filter->get('{{ $field->getName() }}')))@if($last);@endif
@break
@case('bool')
            ->set{{ \Illuminate\Support\Str::ucfirst($field->getName()) }}(StringConvertHelper::toBoolean($filter->get('{{ $field->getName() }}'), null))@if($last);@endif
@break
@case('array')
            ->set{{ \Illuminate\Support\Str::ucfirst($field->getName()) }}(StringConvertHelper::toArray($filter->get('{{ $field->getName() }}')))@if($last);@endif
@break
@case('Carbon')
            ->set{{ \Illuminate\Support\Str::ucfirst($field->getName()) }}(StringConvertHelper::toCarbonByFormat($filter->get('{{ $field->getName() }}')))@if($last);@endif
@break
@default
            ->set{{ \Illuminate\Support\Str::ucfirst($field->getName()) }}(StringConvertHelper::toString($filter->get('{{ $field->getName() }}')))@if($last);@endif
@endswitch

@endforeach
    }

@foreach($filterFields as $index => $field)
@if($index)

@endif
    /**
     * {{ '@' }}return {{ $field->getType() }}|null
     */
    public function get{{ \Illuminate\Support\Str::ucfirst($field->getName()) }}(): ?{{ $field->getType() }}
    {
        return $this->{{ $field->getName() }};
    }

    /**
     * {{ '@' }}param {{ $field->getType() }}|null ${{ $field->getName() }}
     * {{ '@' }}return self
     */
    public function set{{ \Illuminate\Support\Str::ucfirst($field->getName()) }}(?{{ $field->getType() }} ${{ $field->getName() }}): self
    {
        $this->{{ $field->getName() }} = ${{ $field->getName() }};
        return $this;
    }
@endforeach
}

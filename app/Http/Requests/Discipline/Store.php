<?php namespace App\Http\Requests\Discipline;

use App\Discipline;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class Store
 * @package App\Http\Requests\Discipline
 */
class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @param  Policy $policy
     * @return bool
     */
    public function authorize(Policy $policy)
    {
        return $policy->canStore($this->route('competition'));
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        $cmId = $this->route('competition');

        return [
            'competition_id' => [
                'required', 'numeric',
                // Competition id should exists in database.
                Rule::exists('competitions', 'id'),
                // Url competition id should be same as body identifier.
                Rule::in($cmId),
            ],
            'title' => [
                'required', 'min:3', 'max:255',
                // Title should be unique for current competition.
                Rule::unique('disciplines', 'title')
                    ->where('competition_id', $cmId),
            ],
            'short' => [
                'required', 'min:3', 'max:15',
                // Short title should be unique for current competition.
                Rule::unique('disciplines', 'short')
                    ->where('competition_id', $cmId),
            ],
            'type' => [
                'required', 'min:3', 'max:255',
                Rule::in([Discipline::TYPE_KICKBOXING]),
            ],
            'category_group_type' => [
                'required', 'min:3', 'max:255',
                Rule::in([Discipline::CAT_TYPE_AGE, Discipline::CAT_TYPE_WEIGHT]),
            ],
            'category_type' => [
                'required', 'min:3', 'max:255', 'different:category_group_type',
                Rule::in([Discipline::CAT_TYPE_AGE, Discipline::CAT_TYPE_WEIGHT]),
            ],
            'game_type' => ['required', 'min:3',],
            'description' => ['required', 'min:3',],
        ];
    }
}
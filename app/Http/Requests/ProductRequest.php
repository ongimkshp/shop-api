<?php

namespace App\Http\Requests;

//write schema for product request
/**
 * @OA\Schema(
 *   schema="ProductRequest",
 *   type="object",
 *   required={"title"},
 *   @OA\Property(
 *     property="title",
 *     type="string",
 *     description="Product title",
 *     example="Product title",
 *     maxLength=255
 *     ),
 *   @OA\Property(
 *     property="status",
 *     type="string",
 *     description="Product status",
 *     example="active",
 *     default="active",
 *     enum={"active", "draft", "archived"}
 *     ),
 *   @OA\Property(
 *     property="options",
 *     type="array",
 *     description="Product options",
 *     example={{"name": "Color", "values": {"Red", "Blue"}}},
 *     @OA\Items(
 *       type="object",
 *       @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Option name",
 *         example="Color",
 *         maxLength=255
 *         ),
 *       @OA\Property(
 *         property="values",
 *         type="array",
 *         description="Option values",
 *         example={"Red", "Blue"},
 *         @OA\Items(
 *           type="string",
 *           description="Option value",
 *           example="Red",
 *           maxLength=255
 *           ),
 *         ),
 *       ),
 *      maxItems=3
 *      ),
 *    @OA\Property(
 *      property="variants",
 *      type="array",
 *      description="Product variants",
 *      example={{"option1": "Red", "option2": "Small", "option3": "Round"}},
 *      @OA\Items(
 *        type="object",
 *        @OA\Property(
 *          property="option1",
 *          type="string",
 *          description="Option 1",
 *          example="Red",
 *          maxLength=255
 *          ),
 *        @OA\Property(
 *          property="option2",
 *          type="string",
 *          description="Option 2",
 *          example="Small",
 *          maxLength=255
 *          ),
 *        @OA\Property(
 *          property="option3",
 *          type="string",
 *          description="Option 3",
 *          example="Round",
 *          maxLength=255
 *          ),
 *        ),
 *      maxItems=100
 *      ),
 *    @OA\Property(
 *      property="images",
 *      type="array",
 *      description="Product images",
 *      example={{"https://example.com/image.jpg"}},
 *      @OA\Items(
 *        type="string",
 *        description="Image URL",
 *        example="https://example.com/image.jpg",
 *        maxLength=255
 *        ),
 *      maxItems=100
 *      ),
 *    @OA\Property(
 *      property="description",
 *      type="string",
 *      description="Product description",
 *      example="Product description",
 *      ),
 *   )
 *)
 */

class ProductRequest extends BaseRequest
{
    public function rules()
    {
        $rules =  [
            'title' => 'required|unique:products,title|max:255',
            'status' => 'in:active,draft,archived',
            'options' => 'array|max:3',
            'options.*.name' => 'required|max:255',
            'options.*.values' => 'required|array',
            'options.*.values.*' => 'required|max:255',
            'variants' => 'array|max:100',
            'variants.*.option1' => 'required|max:255',
            'variants.*.option2' => 'max:255',
            'variants.*.option3' => 'max:255',
            'images' => 'array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ];
        if (in_array($this->method(), ['PUT'])) {
            $rules = [
                'title' => 'unique:products,title|max:255',
                'status' => 'in:active,draft,archived',
                'variants' => 'array|max:100',
                'variants.*.id' => 'uuid|required|exists:variants,id',
                'images' => 'array',
                'images.*.id' => 'uuid|exists:product_images,id',
                'images.*.src' => 'string|max:255',
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => "can't be blank",
            'title.unique' => 'has already been taken',
            'title.max' => 'is too long (maximum is 255 characters)',
            'status.in' => 'is incorrect',
            'options.array' => 'is incorrect type (array expected)',
            'options.max' => 'is too long (maximum is 3 items)',
            'variants.array' => 'is incorrect type (array expected)',
            'variants.max' => 'is too long (maximum is 100 items)',
            'images.array' => 'is incorrect type (array expected)',
            'images.*.image_file.required' => "can't be blank",
            'images.*.image_file.image' => 'is not a valid image',
            'images.*.image_file.mimes' => 'is not a valid image',
        ];
    }
}

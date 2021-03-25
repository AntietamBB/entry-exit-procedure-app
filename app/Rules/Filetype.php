<?php

namespace App\Rules;

use App\Models\Type;
use Illuminate\Contracts\Validation\Rule;

class Filetype implements Rule
{
    private $type;
    private $url;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->type = $request->type;
        $this->url = $request->url;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->type == '' || $this->type == null || $this->url != '') {
            return true;
        } else {
            $file_format = $value->getClientOriginalExtension();
            $type_details = Type::find($this->type);

            if($type_details->file_type == 'video' && !in_array($file_format, [
                'mp4', '3gp', 'avi', 'flv', 'mkv', 'mov', 'webm', 'wmv'
            ])) {
                return false;
            } else if($type_details->file_type == 'image' && !in_array($file_format, [
                'bmp', 'gif', 'jpeg', 'jpg', 'png', 'svg'
            ])) {
                return false;
            } else if($type_details->file_type == 'audio' && !in_array($file_format, [
                'm4a', 'mp3', 'oga', 'ogg', 'flac', 'wma', 'wav'
            ])) {
                return false;
            } else if($type_details->file_type == 'pdf' && !in_array($file_format, [
                'pdf'
            ])) {
                return false;
            }

            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid File Format.';
    }
}

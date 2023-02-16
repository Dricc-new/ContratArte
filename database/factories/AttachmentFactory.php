<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\AttachmentType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        return [ 
            'filename' => function (array $attributes) {
                $filename = '';
                do {
                    $filename = Uuid::uuid4()->getHex();
                } while (Attachment::query()->where('attachmenttype_id',$attributes['attachmenttype_id'])->where('filename', $filename)->first() != null);
                Storage::disk('public')->put(AttachmentType::find($attributes['attachmenttype_id'])->folder.'/'.$filename.'.pdf',
                Pdf::loadView('pdfTest',[
                    'title' => $this->faker->words(nb:10,asText:true),
                    'p' => $this->faker->words(nb:100,asText:true)]
                )->stream()); 
                return $filename;
            },
        ];
    }

    public function generateName($type){

    }
}

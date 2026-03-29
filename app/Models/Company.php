<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_name',
        'phone_1',
        'phone_2',
        'phone_3',
        'phone_4',
        'phone_5',
        'email_1',
        'email_2',
        'email_3',
        'logo',
        'favicon',
        'description',
        'facebook_link',
        'instagram_link',
        'youtube_link',
        'x_link',
        'whatsapp_link',
        'threads_link',
        'address',
        'privacy_policy_pdf',
        'video_link',
        'slogan',
        'mission_title',
        'mission_description',
        'mission_image',
        'vision_title',
        'vision_description',
        'vision_image',
        'latitude',
        'longitude',
        'trajectory_title',
        'trajectory_description',
        'trajectory_image',
        'methodology_title',
        'methodology_description',
        'methodology_image',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
        ];
    }

    /**
     * Boot method para eventos del modelo
     */
    protected static function boot()
    {
        parent::boot();

        // Antes de actualizar, verificar si cambiaron las imágenes
        static::updating(function ($company) {
            // Logo
            if ($company->isDirty('logo')) {
                if ($company->getOriginal('logo')) {
                    Storage::disk('public')->delete($company->getOriginal('logo'));
                }
            }

            // Favicon
            if ($company->isDirty('favicon')) {
                if ($company->getOriginal('favicon')) {
                    Storage::disk('public')->delete($company->getOriginal('favicon'));
                }
            }

            // PDF de política
            if ($company->isDirty('privacy_policy_pdf')) {
                if ($company->getOriginal('privacy_policy_pdf')) {
                    Storage::disk('public')->delete($company->getOriginal('privacy_policy_pdf'));
                }
            }

            // Imagen de misión
            if ($company->isDirty('mission_image')) {
                if ($company->getOriginal('mission_image')) {
                    Storage::disk('public')->delete($company->getOriginal('mission_image'));
                }
            }

            // Imagen de visión
            if ($company->isDirty('vision_image')) {
                if ($company->getOriginal('vision_image')) {
                    Storage::disk('public')->delete($company->getOriginal('vision_image'));
                }
            }

            // Imagen de trayectoria
            if ($company->isDirty('trajectory_image')) {
                if ($company->getOriginal('trajectory_image')) {
                    Storage::disk('public')->delete($company->getOriginal('trajectory_image'));
                }
            }

            // Imagen de metodología
            if ($company->isDirty('methodology_image')) {
                if ($company->getOriginal('methodology_image')) {
                    Storage::disk('public')->delete($company->getOriginal('methodology_image'));
                }
            }
        });

        // Antes de eliminar, borrar todos los archivos
        static::deleting(function ($company) {
            // Logo
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            // Favicon
            if ($company->favicon) {
                Storage::disk('public')->delete($company->favicon);
            }
            
            // PDF
            if ($company->privacy_policy_pdf) {
                Storage::disk('public')->delete($company->privacy_policy_pdf);
            }

            // Imagen de misión
            if ($company->mission_image) {
                Storage::disk('public')->delete($company->mission_image);
            }

            // Imagen de visión
            if ($company->vision_image) {
                Storage::disk('public')->delete($company->vision_image);
            }

            // Imagen de trayectoria
            if ($company->trajectory_image) {
                Storage::disk('public')->delete($company->trajectory_image);
            }

            // Imagen de metodología
            if ($company->methodology_image) {
                Storage::disk('public')->delete($company->methodology_image);
            }
        });
    }

    /**
     * Get all phone numbers as an array.
     */
    public function getPhones(): array
    {
        return array_filter([
            $this->phone_1,
            $this->phone_2,
            $this->phone_3,
            $this->phone_4,
            $this->phone_5,
        ]);
    }

    /**
     * Get all emails as an array.
     */
    public function getEmails(): array
    {
        return array_filter([
            $this->email_1,
            $this->email_2,
            $this->email_3,
        ]);
    }

    /**
     * Get all social media links as an array.
     */
    public function getSocialLinks(): array
    {
        return array_filter([
            'facebook' => $this->facebook_link,
            'instagram' => $this->instagram_link,
            'youtube' => $this->youtube_link,
            'x' => $this->x_link,
            'whatsapp' => $this->whatsapp_link,
            'threads' => $this->threads_link,
        ]);
    }

    /**
     * Get mission image URL.
     */
    public function getMissionImageUrl(): ?string
    {
        return $this->mission_image ? Storage::url($this->mission_image) : null;
    }

    /**
     * Get the full URL of the logo.
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }

    /**
     * Get the full URL of the favicon.
     */
    public function getFaviconUrlAttribute()
    {
        return $this->favicon ? Storage::url($this->favicon) : null;
    }

    /**
     * Get the full URL of the privacy policy PDF.
     */
    public function getPrivacyPolicyUrlAttribute()
    {
        return $this->privacy_policy_pdf ? Storage::url($this->privacy_policy_pdf) : null;
    }

    /**
     * Get the full URL of the mission image.
     */
    public function getMissionImageUrlAttribute()
    {
        return $this->mission_image ? Storage::url($this->mission_image) : null;
    }

    /**
     * Get the full URL of vision image.
     */
    public function getVisionImageUrlAttribute()
    {
        return $this->vision_image ? Storage::url($this->vision_image) : null;
    }

    /**
     * Get Google Maps URL.
     */
    public function getGoogleMapsUrlAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
        }
        return null;
    }

    /**
     * Eliminar logo manualmente si es necesario
     */
    public function deleteLogo()
    {
        if ($this->logo && Storage::disk('public')->exists($this->logo)) {
            Storage::disk('public')->delete($this->logo);
            $this->update(['logo' => null]);
            return true;
        }
        return false;
    }

    /**
     * Eliminar favicon manualmente si es necesario
     */
    public function deleteFavicon()
    {
        if ($this->favicon && Storage::disk('public')->exists($this->favicon)) {
            Storage::disk('public')->delete($this->favicon);
            $this->update(['favicon' => null]);
            return true;
        }
        return false;
    }

    /**
     * Eliminar PDF de política manualmente si es necesario
     */
    public function deletePrivacyPolicy()
    {
        if ($this->privacy_policy_pdf && Storage::disk('public')->exists($this->privacy_policy_pdf)) {
            Storage::disk('public')->delete($this->privacy_policy_pdf);
            $this->update(['privacy_policy_pdf' => null]);
            return true;
        }
        return false;
    }

    /**
     * Eliminar imagen de misión manualmente si es necesario
     */
    public function deleteMissionImage()
    {
        if ($this->mission_image && Storage::disk('public')->exists($this->mission_image)) {
            Storage::disk('public')->delete($this->mission_image);
            $this->update(['mission_image' => null]);
            return true;
        }
        return false;
    }

    /**
     * Eliminar imagen de visión manualmente si es necesario
     */
    public function deleteVisionImage()
    {
        if ($this->vision_image && Storage::disk('public')->exists($this->vision_image)) {
            Storage::disk('public')->delete($this->vision_image);
            $this->update(['vision_image' => null]);
            return true;
        }
        return false;
    }
}
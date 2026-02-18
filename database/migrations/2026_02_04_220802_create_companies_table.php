    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->string('business_name');
                $table->string('phone_1');
                $table->string('phone_2')->nullable();
                $table->string('phone_3')->nullable();
                $table->string('phone_4')->nullable();
                $table->string('phone_5')->nullable();
                $table->string('email_1');
                $table->string('email_2')->nullable();
                $table->string('email_3')->nullable();
                $table->string('logo');
                $table->text('description');
                $table->string('facebook_link')->nullable();
                $table->string('instagram_link')->nullable();
                $table->string('youtube_link')->nullable();
                $table->string('x_link')->nullable();
                $table->string('whatsapp_link')->nullable();
                $table->string('threads_link')->nullable();
                $table->text('address');
                $table->string('privacy_policy_pdf')->nullable();
                $table->string('video_link')->nullable();
                $table->string('slogan')->nullable();
                $table->boolean('status')->default(true);
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('companies');
        }
    };
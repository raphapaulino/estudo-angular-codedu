<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

/**
 * App\Models\ProductPhoto
 *
 * @property int $id
 * @property string $file_name
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $photo_url
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPhoto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPhoto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPhoto query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPhoto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPhoto whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPhoto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPhoto whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPhoto whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductPhoto extends Model
{
    const BASE_PATH     = 'app/public';
    const DIR_PRODUCTS  = 'products';
    const PRODUCTS_PATH = self::BASE_PATH . '/' . self::DIR_PRODUCTS;

    protected $fillable = ['file_name', 'product_id'];

    public static function photosPath($productId)
    {
        $path = self::PRODUCTS_PATH;
        return storage_path("{$path}/{$productId}"); // caminho absoluto até o diretório que irá armazenar as imagens do produto
    }

    public static function createWithPhotosFiles(int $productId, array $files): Collection
    {
        try {

            self::uploadFiles($productId, $files);
            \DB::beginTransaction();
            $photos = self::createPhotoModels($productId, $files);
            // throw new \Exception('lançando exceção');
            \DB::commit();
            return new Collection($photos);
            
        } catch (\Exception $e) {

            self::deleteFiles($productId, $files);
            \DB::rollBack();
            throw $e;

        }
    }

    public function updateWithPhoto(UploadedFile $file): ProductPhoto
    {
        try {

            /** 
             * @TODO mover a foto antiga para uma área temporária, 
             * na sequência, se der um problema entre beginTransaction() e commit()
             * "restaurar" essa imagem no diretório de origem 
             * dica: usar o método photosPath($productId) para "pegar" a imagem
             * \File::copy(sys_get_temp_dir()) -> salvar o caminho em uma variável 
             * ou no DB
             */
            self::uploadFiles($this->product_id, [$file]);
            \DB::beginTransaction();
            $this->deletePhoto($this->file_name);
            $this->file_name = $file->hashName();
            $this->save();
            // throw new \Exception('lançando exceção');
            \DB::commit();
            return $this;
            
        } catch (\Exception $e) {

            self::deleteFiles($this->product_id, [$file]);
            \DB::rollBack();
            throw $e;

        }
    }

    public function deleteWithPhoto(): bool
    {
        try {

            \DB::beginTransaction();
            $this->deletePhoto($this->file_name);
            $result = $this->delete();
            // throw new \Exception('lançando exceção');
            \DB::commit();
            return $result;
            
        } catch (\Exception $e) {

            /** 
             * @TODO criar um backup da foto para evitar erro no sistema,
             * mesmo explicado no método updateWithPhoto()
             */
            \DB::rollBack();
            throw $e;

        }
    }

    private function deletePhoto($fileName)
    {
        $dir = self::photosDirectory($this->product_id);
        \Storage::disk('public')->delete("{$dir}/{$fileName}");
    }

    private static function deleteFiles(int $productId, array $files)
    {
        /** @var UploadedFile $file */
        foreach ($files as $file) {
            $path = self::photosPath($productId);
            $photoPath = "{$path}/{$file->hashName()}";
            if (file_exists($photoPath)) {
                \File::delete($photoPath);
            }
        }
    }

    public static function uploadFiles($productId, array $files)
    {
        $dir = self::photosDirectory($productId);
        /** @var UploadedFile $file */
        foreach ($files as $file) {
            $file->store($dir, ['disk' => 'public']);
        }
    }

    // retorna um array com todas as fotos que foram criadas
    private static function createPhotoModels(int $productId, array $files): array
    {
        $photos = [];
        /** @var UploadedFile $file */
        foreach ($files as $file) {
            $photos[] = self::create([
                'file_name' => $file->hashName(),
                'product_id' => $productId
            ]);
        }
        return $photos;
    }

    // accessor
    public function getPhotoUrlAttribute()
    {
        $path = self::photosDirectory($this->product_id);
        return asset("storage/{$path}/{$this->file_name}");
    }

    public static function photosDirectory($productId)
    {
        $dir = self::DIR_PRODUCTS;
        return "{$dir}/{$productId}";
    }

    public function product()
    {
        // return $this->belongsTo(Product::class);
        return $this->belongsTo(Product::class)->withTrashed();
    }
}

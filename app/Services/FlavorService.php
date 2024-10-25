namespace App\Services;

use App\Models\Flavor;
use App\Http\Enums\TamanhoEnum;
use Illuminate\Support\Facades\Log;

class FlavorService
{
    public function getAllFlavors()
    {
        return [
            'status' => 200,
            'message' => 'Sabores encontrados!',
            'sabores' => Flavor::select('id', 'sabor', 'preco', 'tamanho')->paginate(10)
        ];
    }

    public function createFlavor(array $data)
    {
        $flavor = Flavor::create([
            'sabor' => $data['sabor'],
            'preco' => $data['preco'],
            'tamanho' => TamanhoEnum::from($data['tamanho']),
        ]);

        return [
            'status' => 200,
            'message' => 'Sabor cadastrado com sucesso!',
            'sabor' => $flavor
        ];
    }

    public function findFlavor(string $id)
    {
        $flavor = Flavor::find($id);
        return $flavor ? 
            [
                'status' => 200,
                'message' => 'Sabor encontrado com sucesso!',
                'sabor' => $flavor
            ] :
            [
                'status' => 404,
                'message' => 'Sabor não encontrado!',
                'sabor' => null
            ];
    }

    public function updateFlavor(string $id, array $data)
    {
        $flavor = Flavor::find($id);
        
        if (!$flavor) {
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado!'
            ];
        }
        
        $flavor->update($data);

        return [
            'status' => 200,
            'message' => 'Sabor atualizado com sucesso!',
            'sabor' => $flavor
        ];
    }

    public function deleteFlavor(string $id)
    {
        $flavor = Flavor::find($id);

        if (!$flavor) {
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado!'
            ];
        }

        $flavor->delete();

        return [
            'status' => 200,
            'message' => 'Sabor deletado com sucesso!'
        ];
    }
}

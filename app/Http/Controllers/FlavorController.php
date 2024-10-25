namespace App\Http\Controllers;

use App\Http\Enums\TamanhoEnum;
use App\Http\Requests\FlavorCreatRequest;
use App\Services\FlavorService;
use Illuminate\Http\Request;

/**
 * Class FlavorController
 *
 * @package App\Http\Controllers
 */
class FlavorController extends Controller
{
    private $flavorService;

    public function __construct(FlavorService $flavorService)
    {
        $this->flavorService = $flavorService;
    }

    public function index()
    {
        return $this->flavorService->getAllFlavors();
    }

    public function store(FlavorCreatRequest $request)
    {
        $data = $request->validated();
        return $this->flavorService->createFlavor($data);
    }

    public function show(string $id)
    {
        return $this->flavorService->findFlavor($id);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        return $this->flavorService->updateFlavor($id, $data);
    }

    public function destroy(string $id)
    {
        return $this->flavorService->deleteFlavor($id);
    }
}

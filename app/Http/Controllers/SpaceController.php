<?php

namespace App\Http\Controllers;

use App\Models\Particle;
use App\Models\Space;
use App\Models\UserInSpace;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SpaceController extends Controller
{

    /*******************************************************************************
     *
     * Function: SpaceController.validateFormData()
     * Purpose: Validates data pertaining to Spaces.
     * Precondition: N/A.
     * Postcondition: The form data is validated.
     *
     * @param Request $request The entire http request.
     * @param bool $requireImages Determines whether images should be required.
     * @return array Array of the validated form view.
     * @throws ValidationException Exception thrown when the data is not successfully
     *                             validated.
     *******************************************************************************/
    private function validateFormData(Request $request, bool $requireImages) {
        if ($requireImages) {
            return $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'icon_picture' => ['image', 'required'],
                'banner_picture' => ['image', 'required']
            ]);
        } else {
            return $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'icon_picture' => 'image',
                'banner_picture' => 'image'
            ]);
        }
    }

    /***************************************************************************
     *
     * Function: SpaceController.assignUserToSpace()
     * Purpose: Uploads an image to the server using a given path.
     * Precondition: N/A.
     * Post-condition: The image is uploaded to the server.
     *
     * @param Space $space The space the current user is being assigned to.
     * @param bool $isOwner Determines if the user is the owner of the space.
     * @return string The final relative file path to the image.
     *
     **************************************************************************/
    private function assignUserToSpace(Space $space) {
        $spaceConnection = new UserInSpace;

        $spaceConnection->fill([
            'user_id' => auth()->user()->id,
            'space_id' => $space->id
        ]);

        $spaceConnection->save();
    }

    /***************************************************************************
     *
     * Function: SpaceController.uploadImage()
     * Purpose: Uploads an image to the server using a given path.
     * Precondition: N/A.
     * Post-condition: The image is uploaded to the server.
     *
     * @param String $imagePath The path that the image will be saved to.
     * @param UploadedFile $image The image that will be saved to the server.
     * @return string The final relative file path to the image.
     *
     *************************************************************************/
    private function uploadImage(string $imagePath, UploadedFile $image) {
        $imageName = $image->hashName();
        $image->store($imagePath);

        return $imagePath . $imageName;
    }

    /***************************************************************************
     *
     * Function: SpaceController.index()
     * Purpose: Displays a list of all public spaces.
     * Precondition: N/A.
     * Post-condition: N/A.
     *
     * @return View The view containing the list of spaces.
     *
     *************************************************************************/
    public function index() {
        $spaces = Space::all();

        return view('spaces.list')->with(['spaces' => $spaces]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() {
        $response = Gate::inspect('create', Space::class);

        if ($response->allowed()) {
            return view('spaces.create');
        } else {
            return redirect('/')->withErrors($response->message());
        }
    }

    /********************************************************************************
     *
     * Function: SpaceController.store(Request $request)
     * Purpose: Creates a new Space object using user-input data and stores
     *          it within the database.
     * Precondition: The form data is valid.
     * Postcondition: A new Space model is instantiated.
     *
     * @param Request $request The full http request.
     * @return Response A redirection to the homepage.
     *
     *******************************************************************************/
    public function store(Request $request) {
        $response = Gate::inspect('create');

        if ($response->allowed()) {
            $validatedData = $this->validateFormData($request, true);

            $iconImagePath = 'images/space_icons/';
            $bannerImagePath = 'images/banner_images/';

            $finalIconPath = $this->uploadImage($iconImagePath, $validatedData['icon_picture']);
            $finalBannerPath = $this->uploadImage($bannerImagePath, $validatedData['banner_picture']);

            $space = new Space;
            $space->fill([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'owner_id' => auth()->user()->id,
                'icon_picture_path' => $finalIconPath,
                'banner_picture_path' => $finalBannerPath
            ]);

            $space->save();

            $this->assignUserToSpace($space);

            return redirect('/')->with(['status' => 'success']);
        } else {
            return redirect('/')->withErrors($response->message());
        }
    }


    /***************************************************************************
     *
     * Function: SpaceController.show()
     * Purpose: Displays a space, as well as its particles, to the user.
     * Precondition: N/A.
     * Post-condition: N/A.
     *
     * TODO: Decouple particles from spaces if possible.
     *
     * @param $id int The ID of the space being accessed.
     * @return View The view containing the particles of the space.
     *
     **************************************************************************/
    public function show($id) {
        $space = Space::find($id);
        $particles = Particle::with('user')
            ->where('space_id', $id)
            ->get();

        return view('spaces.home')->with(['space' => $space, 'particles' => $particles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $space = Space::find($id);

        $response = Gate::inspect('update', $space);

        if ($response->allowed()) {
            return view('spaces.update')->with(['space' => $space]);
        } else {
            return redirect('/')->withErrors($response->message());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id) {
        $space = Space::find($id);

        $response = Gate::inspect('update', $space);

        if ($response->allowed()) {
            $validatedData = $this->validateFormData($request, false);

            if (isset($space)) {
                $iconImagePath = 'images/space_icons/';
                $bannerImagePath = 'images/banner_images/';


                if (isset($validatedData['icon_picture'])) {
                    $finalIconPath = $this->uploadImage($iconImagePath, $validatedData['icon_picture']);
                } else {
                    $finalIconPath = $space->icon_picture_path;
                }

                if (isset($validatedData['banner_picture'])) {
                    $finalBannerPath = $this->uploadImage($bannerImagePath, $validatedData['banner_picture']);
                } else {
                    $finalBannerPath = $space->banner_picture_path;
                }

                $space->fill([
                    'name' => $validatedData['name'],
                    'description' => $validatedData['description'],
                    'icon_picture_path' => $finalIconPath,
                    'banner_picture_path' => $finalBannerPath
                ]);

                $space->save();

                return redirect('/')->with(['status' => 'success']);
            } else {
                return back()->withErrors(['There is no space with the ID supplied.']);
            }
        } else {
            return back()->withErrors($response->message());
        }
    }

    /********************************************************************************
     *
     * Function: SpaceController.destroy().
     * Purpose: Remove the specified resource from storage.
     * Precondition: The space exists within the database.
     * Postcondition: The space is removed from the database, and any
     *                files associated with it are deleted.
     *
     * @param  int $id ID of the space to be deleted.
     * @return Response Redirection to the homepage.
     *
     *******************************************************************************/
    public function destroy(int $id) {
        $space = Space::find($id);

        $response = Gate::inspect('delete', $space);

        if ($response->allowed()) {
            if (isset($space)) {
                if (Storage::exists($space->icon_picture_path)) {
                    Storage::delete($space->icon_picture_path);
                }
                if (Storage::exists($space->banner_picture_path)) {
                    Storage::delete($space->banner_picture_path);
                }

                $space->delete();

                return redirect('/')->with(['status' => 'success']);
            }
        } else {
            return back()
                ->withErrors($response->message());
        }
    }
}

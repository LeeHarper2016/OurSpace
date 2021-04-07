<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpaceRequest;
use App\Models\Particle;
use App\Models\Space;
use App\Models\UserInSpace;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SpaceController extends Controller
{
    /***************************************************************************
     *
     * Function: SpaceController.assignUserToSpace(Space $space)
     * Purpose: Uploads an image to the server using a given path.
     * Precondition: N/A.
     * Post-condition: The image is uploaded to the server.
     *
     * @param Space $space The space the current user is being assigned to.
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
     * Function: SpaceController.uploadImage(string $imagePath, UploadedFile $image)
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
     * Function: SpaceController.join(int $id)
     * Purpose: Allows a user to join a specified space.
     * Precondition: N/A.
     * Post-condition: N/A.
     *
     * @param int $id The ID of the space the user wants to join.
     * @return mixed The view containing the list of spaces.
     *
     *************************************************************************/
    public function join(int $id) {
        if (!is_null(auth()->user())) {
            $space = Space::find($id);

            $this->assignUserToSpace($space);
        } else {
            return back()->withErrors('You are not currently logged in.');
        }
    }

    /***************************************************************************
     *
     * Function: SpaceController.index()
     * Purpose: Displays a list of all public spaces.
     * Precondition: N/A.
     * Post-condition: N/A.
     *
     * @return mixed The view containing the list of spaces.
     *
     *************************************************************************/
    public function index() {
        $spaces = Space::all();

        return view('spaces.list')->with(['spaces' => $spaces]);
    }

    /***************************************************************************
     *
     * Function: SpaceController.create().
     * Purpose: Show the form for creating a new resource.
     * Precondition: The user is authenticated to perform the action.
     * Postcondition: N/A.
     *
     * @return mixed The view containing the form used to create a space, or a
     *               redirection to the homepage if the action was not
     *               authenticated.
     *
     **************************************************************************/
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
     * Function: SpaceController.store(SpaceRequest $request)
     * Purpose: Creates a new Space object using user-input data and stores
     *          it within the database.
     * Precondition: The form data is valid.
     * Postcondition: A new Space model is instantiated.
     *
     * @param SpaceRequest $request The validated request object.
     * @return mixed A redirection to the homepage, including errors if necessary.
     *
     *******************************************************************************/
    public function store(SpaceRequest $request) {
        $response = Gate::inspect('create', Space::class);

        if ($response->allowed()) {
            $validatedData = $request->validated();
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
     * Function: SpaceController.show(int $id)
     * Purpose: Displays a space, as well as its particles, to the user.
     * Precondition: N/A.
     * Post-condition: N/A.
     *
     * TODO: Decouple particles from spaces if possible.
     *
     * @param $id int The ID of the space being accessed.
     * @return mixed The view containing the particles of the space.
     *
     **************************************************************************/
    public function show(int $id) {
        $space = Space::find($id);
        $particles = Particle::with('user')
            ->where('space_id', $id)
            ->get();

        return view('spaces.home')->with(['space' => $space, 'particles' => $particles]);
    }

    /***************************************************************************
     *
     * Function: SpaceController.edit(int $id).
     * Purpose: Show the form for editing the specified resource.
     * Precondition: The user is authenticated to view the form.
     * Postcondition: N/A.
     *
     * @param  int $id The ID of the space to be edited.
     * @return mixed The view containing the form to edit the space, or a
     *               redirection if the action was not authenticated.
     *
     **************************************************************************/
    public function edit(int $id) {
        $space = Space::find($id);

        $response = Gate::inspect('update', $space);

        if ($response->allowed()) {
            return view('spaces.update')->with(['space' => $space]);
        } else {
            return redirect('/')->withErrors($response->message());
        }

    }

    /***************************************************************************
     *
     * Function: SpaceController.update(SpaceRequest $request, int $id).
     * Purpose: Update the specified resource in storage.
     * Precondition: The user is authenticated to perform the action.
     * Postcondition: N/A.
     *
     * @param SpaceRequest $request The validated request object.
     * @param int $id The ID of the space to be edited.
     * @return mixed Redirection to the homepage if successful, redirection to
     *               previous page if there are errors.
     *
     **************************************************************************/
    public function update(SpaceRequest $request, int $id) {
        $space = Space::find($id);

        $response = Gate::inspect('update', $space);

        if ($response->allowed()) {
            $validatedData = $request->validated();

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
     * Function: SpaceController.destroy(int $id).
     * Purpose: Remove the specified resource from storage.
     * Precondition: The space exists within the database.
     * Postcondition: The space is removed from the database, and any
     *                files associated with it are deleted.
     *
     * @param  int $id ID of the space to be deleted.
     * @return mixed Redirection to the homepage.
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

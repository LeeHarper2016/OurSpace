<?php

namespace App\Http\Controllers;

use App\Models\UserInSpace;
use Illuminate\Contracts\View\View;
use Illuminate\Http\UploadedFile;

use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpaceController extends Controller
{

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
    private function assignUserToSpace(Space $space, bool $isOwner) {
        $spaceConnection = new UserInSpace;
        $spaceConnection->fill([
            'user_id' => auth()->user()->id,
            'space_id' => $space->id,
            'is_owner' => $isOwner
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

        return Storage::url($imagePath . $imageName);
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
    public function index()
    {
        $spaces = Space::all();

        return view('spaces.show_public')->with(['spaces' => $spaces]);
    }

    /**
     * Display a private listing of the resource.
     *
     * @return Response
     */
    public function privateIndex()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('spaces.create');
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
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'icon_picture' => ['image', 'required'],
            'banner_picture' => ['image', 'required']
        ]);

        $iconImagePath = 'public/images/space_icons/';
        $bannerImagePath = 'public/images/banner_images/';

        $finalIconPath = $this->uploadImage($iconImagePath, $validatedData['icon_picture']);
        $finalBannerPath = $this->uploadImage($bannerImagePath, $validatedData['banner_picture']);

        $space = new Space;
        $space->fill([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'icon_picture_path' => $finalIconPath,
            'banner_picture_path' => $finalBannerPath
        ]);

        $space->save();

        $this->assignUserToSpace($space, true);

        return redirect('/')->with(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

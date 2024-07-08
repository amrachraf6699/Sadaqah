<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Models\Campaign;
use App\Traits\UploadImage;
use Illuminate\Support\Str;

class CampaignsController extends Controller
{
    use UploadImage;
    
    public function storeCampaign(CreateCampaignRequest $request)
    {
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'goal_amount' => $request->goal_amount,
            'end_date' => $request->end_date,
            'user_id' => auth()->id(),
        ];

        if ($request->hasFile('image')) {
            $path = $this->uploadImage($request->file('image'), 'images/campaigns');
            $data['image'] = $path;
        }

        Campaign::create($data);

        return redirect()->route('user.profile')->with('success', 'Campaign created successfully');
    }


    public function editCampaign(Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        return view('user.campaign.edit', compact('campaign'));
    }


    public function updateCampaign(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'goal_amount' => $request->goal_amount,
            'end_date' => $request->end_date,
        ];


        if ($request->hasFile('image')) {
            $path = $this->uploadImage($request->file('image'), 'images/campaigns', $campaign->image);
            $data['image'] = $path;
        }

        $campaign->update($data);

        return redirect()->route('user.profile')->with('success', 'Campaign updated successfully');
    }


    public function deleteCampaign(Campaign $campaign)
    {
        $this->authorize('delete', $campaign);

        $campaign->delete();

        return redirect()->route('user.profile')->with('success', 'Campaign deleted successfully');
    }


}

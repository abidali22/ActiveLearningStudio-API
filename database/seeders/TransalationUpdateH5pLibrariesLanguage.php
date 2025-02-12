<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransalationUpdateH5pLibrariesLanguage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $translation = '{
            "libraryStrings": {
              "selectVideo": "You must select a video before adding interactions.",
              "noVideoSource": "No Video Source",
              "notVideoField": "\":path\" is not a video.",
              "notImageField": "\":path\" is not a image.",
              "insertElement": "Click and drag to place :type",
              "popupTitle": "Edit :type",
              "done": "Done",
              "loading": "Loading...",
              "remove": "Delete",
              "removeInteraction": "Are you sure you wish to delete this interaction?",
              "addBookmark": "Add bookmark at @timecode",
              "newBookmark": "New bookmark",
              "bookmarkAlreadyExists": "Bookmark already exists here. Move playhead and add a bookmark or a submit screen at another time.",
              "tourButtonStart": "Tour",
              "tourButtonExit": "Exit",
              "tourButtonDone": "Done",
              "tourButtonBack": "Back",
              "tourButtonNext": "Next",
              "tourStepUploadIntroText": "<p>This tour guides you through the most important features of the Interactive Video editor.</p><p>Start this tour at any time by pressing the Tour button in the top right corner.</p><p>Press EXIT to skip this tour or press NEXT to continue.</p>",
              "tourStepUploadFileTitle": "Adding video",
              "tourStepUploadFileText": "<p>Start by adding a video file. You can upload a file from your computer or paste a URL to a YouTube video or a supported video file.</p><p>To ensure compatibility across browsers, you can upload multiple file formats of the same video, such as mp4 and webm.</p>",
              "tourStepUploadAddInteractionsTitle": "Adding interactions",
              "tourStepUploadAddInteractionsText": "<p>Once you have added a video, you can start adding interactions.</p><p>Press the <em>Add interactions</em> tab to get started.</p>",
              "tourStepCanvasToolbarTitle": "Adding interactions",
              "tourStepCanvasToolbarText": "To add an interaction, drag an element from the toolbar and drop it onto the video.",
              "tourStepCanvasEditingTitle": "Editing interactions",
              "tourStepCanvasEditingText": "<p>Once an interaction has been added, you can drag to reposition it.</p><p>To resize an interaction, press on the handles and drag.</p><p>When you select an interaction, a context menu will appear. To edit the content of the interaction, press the Edit button in the context menu. You can remove an interaction by pressing the Remove button on the context menu.</p>",
              "tourStepCanvasBookmarksTitle": "Bookmarks",
              "tourStepCanvasBookmarksText": "You can add Bookmarks from the Bookmarks menu. Press the Bookmark button to open the menu.",
              "tourStepCanvasEndscreensTitle": "Submit Screens",
              "tourStepCanvasEndscreensText": "You can add submit screens from the submit screens menu. Press the submit screen button to open the menu.",
              "tourStepCanvasPreviewTitle": "Preview your interactive video",
              "tourStepCanvasPreviewText": "Press the Play button to preview your interactive video while editing.",
              "tourStepCanvasSaveTitle": "Save and view",
              "tourStepCanvasSaveText": "When you re done adding interactions to your video, press Save/Create to view the result.",
              "tourStepSummaryText": "This optional Summary quiz will appear at the end of the video.",
              "fullScoreRequiredPause": "\"Full score required\" option requires that \"Pause\" is enabled.",
              "fullScoreRequiredRetry": "\"Full score required\" option requires that \"Retry\" is enabled",
              "fullScoreRequiredTimeFrame": "There already exists an interaction that requires full score at the same interval as this interaction.<br /> Only one of the interactions will be required to answer.",
              "addEndscreen": "Add submit screen at @timecode",
              "endscreen": "Submit screen",
              "endscreenAlreadyExists": "Submit screen already exists here. Move playhead and add a submit screen or a bookmark at another time.",
              "tooltipBookmarks": "Click to add bookmark at the current point in the video",
              "tooltipEndscreens": "Click to add submit screen at the current point in the video",
              "expandBreadcrumbButtonLabel": "Go back",
              "collapseBreadcrumbButtonLabel": "Close navigation",
              "deleteInteractionTitle": "Deleting interaction",
              "cancel": "Cancel",
              "confirm": "Confirm",
              "ok": "Ok"
            }
          }' ;
        // 
       $id = DB::table('h5p_libraries')->
        where([ ['name', 'H5PEditor.InteractiveVideo'], 
                ['major_version',1], 
                ['minor_version', 22]])->first();
        
        DB::table('h5p_libraries_languages')->
        where([['library_id',$id->id],['language_code','en']])->
        update(['translation' => $translation]);
    }
}

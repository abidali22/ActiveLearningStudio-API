<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class H5PUpdateEssayHideSolutionBehaviourSemanticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $h5pEssayLibParams = ['name' => "H5P.Essay", "major_version" => 1, "minor_version" => 5];
        $h5pEssayLib = DB::table('h5p_libraries')->where($h5pEssayLibParams)->first();
        if ($h5pEssayLib) {
            DB::table('h5p_libraries')->where($h5pEssayLibParams)->update([
                'semantics' => $this->updatedSemantics()
            ]);
        }
    }

    private function updatedSemantics() {
        return '[
  {
    "name": "media",
    "type": "group",
    "label": "Media",
    "importance": "medium",
    "fields": [
      {
        "name": "type",
        "type": "library",
        "label": "Type",
        "importance": "medium",
        "options": [
          "H5P.Image 1.1",
          "H5P.Video 1.5"
        ],
        "optional": true,
        "description": "Optional media to display above the question."
      },
      {
        "name": "disableImageZooming",
        "type": "boolean",
        "label": "Disable image zooming",
        "importance": "low",
        "default": false,
        "optional": true,
        "widget": "showWhen",
        "showWhen": {
          "rules": [
            {
              "field": "type",
              "equals": "H5P.Image 1.1"
            }
          ]
        }
      }
    ]
  },
  {
    "name": "taskDescription",
    "label": "Task description",
    "type": "text",
    "widget": "html",
    "importance": "high",
    "description": "Describe your task here. The task description will appear above text input area.",
    "placeholder": "Summarize the book in 500 characters ...",
    "enterMode": "div",
    "tags": [
      "strong",
      "em",
      "u",
      "a",
      "ul",
      "ol",
      "h2",
      "h3",
      "hr",
      "pre",
      "code"
    ]
  },
  {
    "name": "placeholderText",
    "label": "Help text",
    "type": "text",
    "description": "This text should help the user to get started.",
    "placeholder": "This book is about ...",
    "importance": "low",
    "optional": true
  },
  {
    "name": "solution",
    "type": "group",
    "label": "Sample solution",
    "importance": "high",
    "expanded": true,
    "description": "You can optionally add a sample solution that\'s shown after the student created a text. It\'s called sample solution because there probably is not only one solution",
    "fields": [
      {
        "name": "introduction",
        "type": "text",
        "label": "Introduction",
        "importance": "low",
        "description": "You can optionally leave the students some explanations about your example. The explanation will only show up if you add an example, too.",
        "placeholder": "Please remember that you were not expected to come up with the exact same solution. It\'s just a good example.",
        "optional": true,
        "widget": "html",
        "enterMode": "div",
        "tags": [
          "strong",
          "em",
          "u",
          "a",
          "ul",
          "ol",
          "hr",
          "code"
        ]
      },
      {
        "name": "sample",
        "type": "text",
        "label": "Sample solution text",
        "importance": "low",
        "description": "The student will see a \"Show solution\" button after submitting if you provide some text here.",
        "optional": true,
        "widget": "html",
        "enterMode": "div",
        "tags": [
          "strong",
          "a"
        ]
      }
    ]
  },
  {
    "name": "keywords",
    "label": "Keywords",
    "importance": "high",
    "type": "list",
    "widgets": [
      {
        "name": "VerticalTabs",
        "label": "Default"
      }
    ],
    "min": 1,
    "entity": "Keyword",
    "field": {
      "name": "groupy",
      "type": "group",
      "label": "Keyword",
      "fields": [
        {
          "name": "keyword",
          "type": "text",
          "label": "Keyword",
          "description": "Keyword or phrase to look for. Use an asterisk \'*\' as a wildcard for one or more characters. Use a slash \'/\' at the beginning and the end to use a regular expression.",
          "importance": "medium"
        },
        {
          "name": "alternatives",
          "type": "list",
          "label": "Variations",
          "description": "Add optional variations for this keyword. Example: For a \'city\' add alternatives \'town\', \'municipality\' etc. Points will be awarded if the user includes any of the specified alternatives.",
          "importance": "medium",
          "entity": "variation",
          "optional": true,
          "min": 0,
          "field": {
            "name": "alternative",
            "type": "text",
            "label": "Keyword variation"
          }
        },
        {
          "name": "options",
          "type": "group",
          "label": "Points, Options and Feedback",
          "importance": "low",
          "fields": [
            {
              "name": "points",
              "type": "number",
              "label": "Points",
              "default": 1,
              "description": "Points that the user will get if he/she includes this keyword or its alternatives in the answer.",
              "min": 1
            },
            {
              "name": "occurrences",
              "type": "number",
              "label": "Occurrences",
              "default": 1,
              "description": "Define how many occurrences of the keyword or its variations should be awarded with points.",
              "min": 1
            },
            {
              "name": "caseSensitive",
              "type": "boolean",
              "label": "Case sensitive",
              "default": true,
              "description": "Makes sure the user input has to be exactly the same as the answer."
            },
            {
              "name": "forgiveMistakes",
              "type": "boolean",
              "label": "Forgive minor mistakes",
              "description": "This will accept minor spelling mistakes (3-9 characters: 1 mistake, more than 9 characters: 2 mistakes)."
            },
            {
              "name": "feedbackIncluded",
              "type": "text",
              "label": "Feedback if keyword included",
              "description": "This feedback will be displayed if the user includes this keyword or its alternatives in the answer.",
              "optional": true,
              "maxLength": 1000
            },
            {
              "name": "feedbackMissed",
              "type": "text",
              "label": "Feedback if keyword missing",
              "description": "This feedback will be displayed if the user doesn’t include this keyword or its alternatives in the answer.",
              "optional": true,
              "maxLength": 1000
            },
            {
              "name": "feedbackIncludedWord",
              "type": "select",
              "label": "Feedback word shown if keyword included",
              "importance": "low",
              "description": "This option allows you to specify which word should be shown in front of your feedback if a keyword was found in the text.",
              "optional": false,
              "default": "keyword",
              "options": [
                {
                  "value": "keyword",
                  "label": "keyword"
                },
                {
                  "value": "alternative",
                  "label": "alternative found"
                },
                {
                  "value": "answer",
                  "label": "answer given"
                },
                {
                  "value": "none",
                  "label": "none"
                }
              ]
            },
            {
              "name": "feedbackMissedWord",
              "type": "select",
              "label": "Feedback word shown if keyword missing",
              "importance": "low",
              "description": "This option allows you to specify which word should be shown in front of your feedback if a keyword was not found in the text.",
              "optional": false,
              "default": "none",
              "options": [
                {
                  "value": "keyword",
                  "label": "keyword"
                },
                {
                  "value": "none",
                  "label": "none"
                }
              ]
            }
          ]
        }
      ]
    }
  },
  {
    "name": "overallFeedback",
    "type": "group",
    "label": "Overall Feedback",
    "importance": "low",
    "expanded": true,
    "fields": [
      {
        "name": "overallFeedback",
        "type": "list",
        "widgets": [
          {
            "name": "RangeList",
            "label": "Default"
          }
        ],
        "importance": "high",
        "label": "Define custom feedback for any score range",
        "description": "Click the \"Add range\" button to add as many ranges as you need. Example: 0-20% Bad score, 21-91% Average Score, 91-100% Great Score!",
        "entity": "range",
        "min": 1,
        "defaultNum": 1,
        "optional": true,
        "field": {
          "name": "overallFeedback",
          "type": "group",
          "importance": "low",
          "fields": [
            {
              "name": "from",
              "type": "number",
              "label": "Score Range",
              "min": 0,
              "max": 100,
              "default": 0,
              "unit": "%"
            },
            {
              "name": "to",
              "type": "number",
              "min": 0,
              "max": 100,
              "default": 100,
              "unit": "%"
            },
            {
              "name": "feedback",
              "type": "text",
              "label": "Feedback for defined score range",
              "importance": "low",
              "placeholder": "Fill in the feedback",
              "optional": true
            }
          ]
        }
      }
    ]
  },
  {
    "name": "behaviour",
    "type": "group",
    "label": "Behavioural settings",
    "importance": "low",
    "description": "These options will let you control how the task behaves.",
    "fields": [
      {
        "name": "minimumLength",
        "label": "Minimum number of characters",
        "type": "number",
        "description": "Specify the minimum number of characters that the user must enter.",
        "importance": "low",
        "optional": true,
        "min": "0"
      },
      {
        "name": "maximumLength",
        "label": "Maximum number of characters",
        "type": "number",
        "description": "Specify the maximum number of characters that the user can enter.",
        "importance": "low",
        "optional": true,
        "min": "0"
      },
      {
        "name": "inputFieldSize",
        "label": "Input field size",
        "type": "select",
        "importance": "low",
        "description": "The size of the input field in amount of lines it will cover",
        "options": [
          {
            "value": "1",
            "label": "1 line"
          },
          {
            "value": "2",
            "label": "2 lines"
          },
          {
            "value": "3",
            "label": "3 lines"
          },
          {
            "value": "4",
            "label": "4 lines"
          },
          {
            "value": "5",
            "label": "5 lines"
          },
          {
            "value": "10",
            "label": "10 lines"
          }
        ],
        "default": "10"
      },
      {
        "name": "enableRetry",
        "label": "Enable \"Retry\"",
        "type": "boolean",
        "importance": "low",
        "description": "If checked, learners can retry the task.",
        "default": true,
        "optional": true
      },
      {
        "name": "ignoreScoring",
        "label": "Ignore scoring",
        "type": "boolean",
        "importance": "low",
        "description": "If checked, learners will only see the feedback that you provided for the keywords, but no score.",
        "default": false,
        "optional": true
      },
      {
        "name": "pointsHost",
        "label": "Points in host environment",
        "type": "number",
        "importance": "low",
        "description": "Used to award points in host environment merely for answering (not shown to learner).",
        "min": 0,
        "default": 1,
        "widget": "showWhen",
        "showWhen": {
          "rules": [
            {
              "field": "ignoreScoring",
              "equals": true
            }
          ]
        }
      },
      {
        "name": "percentagePassing",
        "type": "number",
        "label": "Passing percentage",
        "description": "Percentage that\'s necessary for passing",
        "optional": true,
        "min": 0,
        "max": 100,
        "widget": "showWhen",
        "showWhen": {
          "rules": [
            {
              "field": "ignoreScoring",
              "equals": false
            }
          ]
        }
      },
      {
        "name": "percentageMastering",
        "type": "number",
        "label": "Mastering percentage",
        "description": "Percentage that\'s necessary for mastering. Setting the mastering percentage below 100 % will lower the maximum possible score accordingly. It\'s intended to give some leeway to students, not to \"graciously accept\" solutions that do not contain all keywords.",
        "optional": true,
        "min": 0,
        "max": 100,
        "widget": "showWhen",
        "showWhen": {
          "rules": [
            {
              "field": "ignoreScoring",
              "equals": false
            }
          ]
        }
      },
      {
        "name": "overrideCaseSensitive",
        "type": "select",
        "label": "Override case sensitive",
        "importance": "low",
        "description": "This option determines if the \"Case sensitive\" option will be activated for all keywords.",
        "optional": true,
        "options": [
          {
            "value": "on",
            "label": "Enabled"
          },
          {
            "value": "off",
            "label": "Disabled"
          }
        ]
      },
      {
        "name": "overrideForgiveMistakes",
        "type": "select",
        "label": "Override forgive mistakes",
        "importance": "low",
        "description": "This option determines if the \"Forgive mistakes\" option will be activated for all keywords.",
        "optional": true,
        "options": [
          {
            "value": "on",
            "label": "Enabled"
          },
          {
            "value": "off",
            "label": "Disabled"
          }
        ]
      },
      {
        "name": "enableSubmitAnswerFeedback",
        "label": "Enable submit answer feedback",
        "type": "boolean",
        "importance": "low",
        "description": "If checked, learners will see the feedback that you provided after submission",
        "default": false,
        "optional": true
      },
      {
        "name": "submissionButtonsAlignment",
        "type": "select",
        "label": "Submission buttons alignment",
        "importance": "low",
        "description": "This option determines alignment for submission buttons",
        "optional": true,
        "default": "left",
        "options": [
          {
            "value": "left",
            "label": "Left"
          },
          {
            "value": "right",
            "label": "Right"
          }
        ]
      },
      {
        "name": "hideSampleSolution",
        "label": "Hide Sample Solution",
        "type": "boolean",
        "importance": "low",
        "description": "If checked, learners will not see the sample solution text",
        "default": false,
        "optional": true
      }
    ]
  },
  {
    "name": "checkAnswer",
    "type": "text",
    "label": "Text for \"Check\" button",
    "importance": "low",
    "default": "Check",
    "common": true
  },
  {
    "name": "tryAgain",
    "label": "Text for \"Retry\" button",
    "type": "text",
    "importance": "low",
    "default": "Retry",
    "common": true
  },
  {
    "name": "showSolution",
    "type": "text",
    "label": "Text for \"Show solution\" button",
    "importance": "low",
    "default": "Show solution",
    "common": true
  },
  {
    "name": "feedbackHeader",
    "type": "text",
    "label": "Header for panel containing feedback for included/missing keywords",
    "importance": "low",
    "default": "Feedback",
    "common": true
  },
  {
    "name": "solutionTitle",
    "type": "text",
    "label": "Label for solution",
    "importance": "low",
    "default": "Sample solution",
    "common": true
  },
  {
    "name": "remainingChars",
    "type": "text",
    "label": "Remaining characters",
    "importance": "low",
    "common": true,
    "default": "Remaining characters: @chars",
    "description": "Message for remaining characters. You can use @chars which will be replaced by the corresponding number."
  },
  {
    "name": "notEnoughChars",
    "type": "text",
    "label": "Not enough characters",
    "importance": "low",
    "common": true,
    "default": "You must enter at least @chars characters!",
    "description": "Message to indicate that the text doesn\'t contain enough characters. You can use @chars which will be replaced by the corresponding number."
  },
  {
    "name": "messageSave",
    "type": "text",
    "label": "Save message",
    "description": "Message indicating that the text has been saved",
    "importance": "low",
    "common": true,
    "default": "saved"
  },
  {
    "name": "ariaYourResult",
    "type": "text",
    "label": "Your result (not displayed)",
    "description": "Accessibility text used for readspeakers. @score will be replaced by the number of points. @total will be replaced by the maximum possible points.",
    "importance": "low",
    "common": true,
    "default": "You got @score out of @total points"
  },
  {
    "name": "ariaNavigatedToSolution",
    "type": "text",
    "label": "Navigation message (not displayed)",
    "description": "Accessibility text used for readspeakers",
    "importance": "low",
    "common": true,
    "default": "Navigated to newly included sample solution after textarea."
  },
  {
    "name": "submitAnswerFeedback",
    "type": "text",
    "label": "Submit answers feedback",
    "description": "Submit answer feedback text",
    "importance": "low",
    "common": true,
    "default": "Your answer has been submitted!"
  },
  {
    "name": "currikisettings",
    "type": "group",
    "label": "Curriki settings",
    "importance": "low",
    "description": "These options will let you control how the curriki studio behaves.",
    "optional": true,
    "fields": [
      {
        "label": "Do not Show Submit Button",
        "importance": "low",
        "name": "disableSubmitButton",
        "type": "boolean",
        "default": false,
        "optional": true,
        "description": "This option only applies to a standalone activity. The Submit button is required for grade passback to an LMS."
      },
      {
        "label": "Placeholder",
        "importance": "low",
        "name": "placeholder",
        "type": "boolean",
        "default": false,
        "optional": true,
        "description": "This option is a place holder. will be used in future"
      },
      {
        "label": "Curriki Localization",
        "description": "Here you can edit settings or translate texts used in curriki settings",
        "importance": "low",
        "name": "currikil10n",
        "type": "group",
        "fields": [
          {
            "label": "Text for \"Submit\" button",
            "name": "submitAnswer",
            "importance": "low",
            "type": "text",
            "default": "Submit",
            "optional": true
          },
          {
            "label": "Text for \"Placeholder\" button",
            "importance": "low",
            "name": "placeholderButton",
            "type": "text",
            "default": "Placeholder",
            "optional": true
          }
        ]
      }
    ]
  }
]';
    }
}

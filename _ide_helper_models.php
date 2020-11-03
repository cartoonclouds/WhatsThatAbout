<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string $commentable_type
 * @property int $commentable_id
 * @property int $user_id
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \App\Models\User $commenter
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $segment
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $show
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Query\Builder|Comment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Comment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Comment withoutTrashed()
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Segment
 *
 * @property int $id
 * @property string|null $start_time The timestamp the reference starts
 * @property string|null $finish_time The timestamp the reference finishes
 * @property bool|null                                                           $runs_throughout Does the reference occur throughout the show?
 * @property string                                                              $details The story regarding what is being referenced
 * @property array|null                                                          $references A JSON object with title as key and URL as value
 * @property int                                                                 $show_id
 * @property int                                                                 $user_id
 * @property \Illuminate\Support\Carbon|null                                     $created_at
 * @property \Illuminate\Support\Carbon|null                                     $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null                                                       $comments_count
 * @property-read \App\Models\User                                               $creator
 * @property-read \App\Models\Page                                               $show
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vote[]    $votes
 * @property-read int|null                                                       $votes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Segment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Segment newQuery()
 * @method static \Illuminate\Database\Query\Builder|Segment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Segment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Segment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Segment whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Segment whereFinishTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Segment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Segment whereReferences($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Segment whereRunsThroughout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Segment whereShowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Segment whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Segment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Segment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Segment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Segment withoutTrashed()
 */
	class Segment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Page
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $synopsis
 * @property string|null $release_year
 * @property string $thumbnail
 * @property string|null $runtime
 * @property array|null $references
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Segment[] $segments
 * @property-read int|null $segments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vote[] $votes
 * @property-read int|null $votes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Page findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Query\Builder|Page onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereReferences($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereReleaseYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereRuntime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSynopsis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Page withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Page withoutTrashed()
 */
	class Show extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string                                                                                                         $password
 * @property string|null                                                                                                    $remember_token
 * @property \Illuminate\Support\Carbon|null                                                                                $created_at
 * @property \Illuminate\Support\Carbon|null                                                                                $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[]                                            $comments
 * @property-read int|null                                                                                                  $comments_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null                                                                                                  $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Segment[]                                            $segments
 * @property-read int|null                                                                                                  $segments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[]                                               $pages
 * @property-read int|null                                                                                                  $shows_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vote[]                                               $votes
 * @property-read int|null                                                                                                  $votes_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Vote
 *
 * @property int $id
 * @property string $votable_type
 * @property int $votable_id
 * @property int $user_id
 * @property bool $vote TRUE is a positive vote, FALSE a negative vote
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $segment
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $show
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $votable
 * @property-read \App\Models\User $voter
 * @method static \Illuminate\Database\Eloquent\Builder|Vote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vote query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereVotableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereVotableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereVote($value)
 */
	class Vote extends \Eloquent {}
}


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
 * App\Models\Type
 *
 * @property int $id
 * @property string|null $definition
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reference[] $references
 * @property-read int|null $references_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Type whereDefinition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Type whereUpdatedAt($value)
 */
	class Type extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Rating
 *
 * @property int $id
 * @property string $country Must use the (ISO-3166-1 ALPHA-3) 3-letter country abbreivations, see: https://laendercode.net/en/3-letter-list.html
 * @property string $rating See: https://www.wikiwand.com/en/Motion_picture_content_rating_system; G, PG, M, MA, R
 * @property string|null $description
 * @property string|null $reference_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Show[] $shows
 * @property-read int|null $shows_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rating whereReferenceUrl($value)
 */
	class Rating extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReferenceUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferenceUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferenceUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferenceUser query()
 */
	class ReferenceUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReferenceShow
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferenceShow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferenceShow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferenceShow query()
 */
	class ReferenceShow extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Genre
 *
 * @property int $id
 * @property string $genre Such as: movie, tv series, anime, special, etc.
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Show[] $shows
 * @property-read int|null $shows_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre whereId($value)
 */
	class Genre extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GenreShow
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GenreShow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GenreShow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GenreShow query()
 */
	class GenreShow extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Vote
 *
 * @property string $votable_type
 * @property int $votable_id
 * @property int $user_id
 * @property int $vote Either  (+)1 for a vote up or -1 for vote down
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $votables
 * @property-read \App\Models\User $voter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vote query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vote whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vote whereVotableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vote whereVotableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vote whereVote($value)
 */
	class Vote extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property bool $hide_email_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reference[] $references
 * @property-read int|null $references_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Show[] $shows
 * @property-read int|null $shows_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereHideEmailAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReferenceType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferenceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferenceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferenceType query()
 */
	class ReferenceType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RatingShow
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RatingShow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RatingShow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RatingShow query()
 */
	class RatingShow extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Show
 *
 * @property int $id
 * @property string|null $imdb_id
 * @property string|null $wikipedia_url
 * @property string|null $official_website_url
 * @property string $image_url
 * @property string|null $running_length
 * @property int $is_draft
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genre[] $genres
 * @property-read int|null $genres_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Rating[] $ratings
 * @property-read int|null $ratings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reference[] $references
 * @property-read int|null $references_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vote[] $votes
 * @property-read int|null $votes_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereImdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereIsDraft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereOfficialWebsiteUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereRunningLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show whereWikipediaUrl($value)
 */
	class Show extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Reference
 *
 * @property int $id
 * @property string|null $start_time The timestampe the reference starts
 * @property string|null $finish_time The timestampe the reference finishes
 * @property int|null $throughout Does the reference occur throughout the show?
 * @property string $comment Poste's comments about the thing they're referencing
 * @property string $references A JSON object with title as key and URL as value
 * @property string|null $imdb_id Format: tt0123456, to generate URL: http://www.imdb.com/title/tt0123456/
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $creator
 * @property-read \App\Models\Show $show
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Type[] $types
 * @property-read int|null $types_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vote[] $votes
 * @property-read int|null $votes_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reference query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reference whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reference whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reference whereFinishTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reference whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reference whereImdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reference whereReferences($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reference whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reference whereThroughout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reference whereUpdatedAt($value)
 */
	class Reference extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ShowUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShowUser query()
 */
	class ShowUser extends \Eloquent {}
}


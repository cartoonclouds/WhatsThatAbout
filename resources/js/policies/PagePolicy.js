export default class PagePolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @param  {object}  user
     * @return mixed
     */
    viewAny(user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  {object}  user
     * @param  {object}  page
     * @return {mixed}
     */
    view(user, page)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  {object}  user
     * @return {mixed}
     */
    create(user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  {object}  user
     * @param  {object}  page
     * @return {mixed}
     */
    update(user, page)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  {object}  user
     * @param  {object}  page
     * @return {mixed}
     */
    restore(user, page)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  {object}  user
     * @param  {object}  page
     * @return {mixed}
     */
    delete(user, page)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  {object}  user
     * @param  {object}  page
     * @return {mixed}
     */
    forceDelete(user, page)
    {
        //
    }
}

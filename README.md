# Statamic Image Upload Bug
## How to reproduce
1. Clone this repo
2. Run `composer install`
3. Copy `.env.example` to `.env`
4. Set up Redis and fill in the `REDIS_HOST`, `REDIS_PASSWORD` and `REDIS_PORT`
5. Clear cache `php artisan cache:clear`
6. Run the worker `php artisan queue:work --tries=1`
7. Open http://image-bug-example.test/cp/collections/articles/entries/581b43b1-1ad9-47ea-b613-76187aba71d0
8. Upload an image to the `file` field in the `image` set of the `content` field
9. Click the `Save & Publish` button
10. The worker will process `App\Listeners\DoSomethingWithEntry` and will write the HTML of the entry to the log file. The HTML will contain the `img` tag of the uploaded image.
11. Keep the worker running and open the entry again
12. Upload a different image to the `file` field in the `image` set of the `content` field. The image should be a new image, not an image that was already uploaded.
13. Click the `Save & Publish` button
14. **Now the HTML will not contain the `img` tag anymore.**

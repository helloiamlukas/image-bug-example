# Statamic Image Upload Bug
## How to reproduce
1. Clone this repo
2. Run `composer install`
3. Replace `vender/statamic/cms/...` files with https://github.com/statamic/cms/pull/6726/files
3. Copy `.env.example` to `.env`
4. Fill in the `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_BUCKET`, `AWS_URL` and `AWS_REGION`
5. Set up Redis and fill in the `REDIS_HOST`, `REDIS_PASSWORD` and `REDIS_PORT`
6. Clear cache `php artisan cache:clear`
7. Run the worker `php artisan queue:work`
8. Open http://image-bug-example.test/cp/collections/articles/entries/581b43b1-1ad9-47ea-b613-76187aba71d0
9. Upload an image and save the entry
10. Open the log file `storage/logs/laravel.log`. It should include the html of the content. The image url should be correct.
11. Again open http://image-bug-example.test/cp/collections/articles/entries/581b43b1-1ad9-47ea-b613-76187aba71d0
12. Remove the previous image from the content field and upload a new image (don't use the same image as before)
13. Click the `Save & Publish` button
14. Open the log file `storage/logs/laravel.log`.
15. **Now the output will include an image with an empty path** (`<img src="" alt="">`)

#!/bin/bash

#curl -X POST https://webhook.site/#!/73b2f50a-40f8-428b-bc5e-cc389081916c/78ede85d-45e1-43ee-83e5-1c4783c9eaa1/1 \
#-H "Content-Type: application/x-www-form-urlencoded" -d "@changelog.json" -k

php changelog2json.php CHANGELOG.md
curl -d @changelog.json https://webhook.site/fc80a019-f8d3-4423-b006-2e7bf3305f5b




# Post Update to Manager
# curl -X POST https://dash.lsdplugins.com/route/lsd/v1/plugin/update \
#     --header "Authorization: Bearer <ACCESS_TOKEN>" \
#     --header "Dropbox-API-Arg: {\"path\": \"/Homework/math/Matrices.txt\"}" \
#     --header "Content-Type: application/octet-stream" \
#     --data-binary @matrices.txt

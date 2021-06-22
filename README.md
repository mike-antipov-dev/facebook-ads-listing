# Simple Facebook Ads fetching app
Client asked for a simple app that will allow a user to register, enter his Facebook Ad token and fetch all campaigns, adsets and ads data.

Because the SDK (at least at that time) couldn't fetch all data, I've developed the getIns function that fetches all stats.

## Files to look at:

app/Http/Controllers/FB.php

app/MarketingApi.php
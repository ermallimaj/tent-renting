# Download the helper library from https://www.twilio.com/docs/python/install
import os
from twilio.rest import Client
# Set environment variables for your credentials
# Read more at http://twil.io/secure
account_sid = "ACda71a4205a50191f3f0ff3494a121ab0"
auth_token = "79cb8927553f1be2ed6d520a64fdd210"
client = Client(account_sid, auth_token)
message = client.messages.create(
  body="Congratulations Endrit Gjokaj! You have been invited to apply for a full scholarship at Harvard for Fall studies. This is an incredible opportunity to pursue your academic dreams. Please visit https://ischoolconnect.com/blog/scholarships-offered-by-harvard-university-how-to-apply/\n"
 "to apply now. Don't wait, the deadline is approaching soon. Good luck! - Harvard Scholarship Committee",
  from_="+13203177174",
  to="+38344806028"
)
print(message.sid)
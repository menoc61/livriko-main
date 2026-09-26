# Livriko — ride & parcel monorepo (DriveMond 3.2 base)

| Package | Path | ID / URL |
|---|---|---|
| Admin panel (Laravel 12, PHP 8.3) | `livriko-admin/` | https://livriko.fr |
| User app (Flutter) | `livriko-user-app-3.2/` | `com.livriko.user` |
| Driver app (Flutter) | `livriko-driver-app-3.2/` | `com.livriko.driver` |
| Brand assets | `_logo/` | — |

## Branding already applied
- App names: `Livriko` / `Livriko Driver` (Dart constants, Android labels, iOS `CFBundleName`)
- Base URL: `https://livriko.fr` (no trailing slash) in both `lib/util/app_constants.dart`
- Logos from `_logo/0.5x` → `assets/image/{logo,logo_with_name,splash_logo,sign_up_logo,otp_screen_logo}.png`
  + white notification icon → `android/app/src/main/res/drawable/notification_icon.png`
- Push channel `hexaride` → `livriko` in both `notification_helper.dart`

## Still placeholders (need keys before store build)
- Google Maps key: `AndroidManifest.xml` (`com.google.android.geo.API_KEY`), `ios/Runner/AppDelegate.swift`,
  driver-only `polylineMapKey` in `app_constants.dart`
- Firebase: `google-services.json` / `GoogleService-Info.plist` + `lib/main.dart` `FirebaseOptions`
  (currently vendor demo values). One Firebase project, two apps inside.
  Enable: Direction, Distance Matrix, Geocoding, Maps SDK (Android/iOS), Maps JavaScript,
  Places, Geolocation, Routes, Places (New) + billing.

## Admin backend
- DB `livriko_admin` (MySQL), Nginx + PHP 8.3-FPM, TLS via Certbot, Reverb WebSocket on `:6001`
  supervised (`/etc/supervisor/conf.d/websockets.conf`).
- After any `.env` edit:
  `php artisan config:clear && php artisan view:clear && php artisan route:clear && php artisan optimize:clear`
  (as `www-data`). Never run `config:cache` on this box.
- `.env` is git-ignored; copy `livriko-admin/.env.example` and fill secrets in CI/deploy.

## Build pipeline (next)
- Mobile builds need Flutter SDK (code targets 3.41.x) + JDK 17 + Xcode for IPA.
- `flutter analyze`, `flutter build appbundle --release` per app.

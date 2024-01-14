WHY NOT A GIF HERE? TO SET THE MOOD.

# Frosty Island

Some text about your lovely island

# Nordic Frost Hotel

Why not add some info about the hotel of your dreams?

# Instructions

If your project requires some installation or similar, please inform your user 'bout it. For instance, if you want a more decent indentation of your .php files, you could edit [.editorconfig]('/.editorconfig').

# Code review

1. Github pages stödjer inte php, använd domänen på one.com.
2. booking.php:43 Kan ändras till ”if (!fun) return false;”, en rad istället för tre rader.
3. booking.php:48 Eftersom uppgiften endast inkluderar januari kan du använda startdag och slutdag istället och skippa strtotime().
4. booking.php:57 Dessa variabler kommer overifierat from posten och kan användas för SQL-injektion. Använd bindparam() även här.
5. booking.php:68 En else-sats behövs inte här, alla fall som blir true returneras i den satsen.
6. bookingDone.php:16 Bygg en array och använd json_encode() istället. Du kan printa json med endast echo, men printen är i detta fall inte json-formaterad.
7. process.php:5 Om ett värde endast används en gång är det smidigare att hoppa över variabeln.
8. process.php:36 Kan vara bra att ansluta till verifieringsservern också c:
9. style.css Du kan nog använda samma styling på form-container på desktop och mobile, alternativt förstora desktopvarianten en aning.
10. index.html Att använda bilder för rummen kan vara smidigt, men du vill nog ha ett sätt att ändra priset till något mer passande för turistens plånbok.

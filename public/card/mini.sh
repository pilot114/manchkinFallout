
for number in {0..279}; do
    echo minimaze $number...
    convert -resize x500 splitted/$number.png mini/$number.png
done

convert -resize x500 splitted/door.png mini/door.png
convert -resize x500 splitted/prize.png mini/prize.png
convert -resize x500 splitted/skill.png mini/skill.png

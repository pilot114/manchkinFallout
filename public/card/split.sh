
for number in {1..28}; do
    echo splitting $number...
    index=$(($number-1))
    convert -crop 5x2@ original/$number.jpg splitted/$index%d.png
done

convert -crop 661x1027+2644+1027 original/_1.jpg splitted/door.png
convert -crop 661x1027+2644+1027 original/_2.jpg splitted/skill.png
convert -crop 661x1027+2644+1027 original/_3.jpg splitted/prize.png

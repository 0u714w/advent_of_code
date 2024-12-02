# Advent of Code Solutions

This repository contains solutions for the Advent of Code challenges. Each solution is implemented in 
Python and is designed to be easily extendable for future updates.

## Table of Contents
- [Advent of Code Solutions](#advent-of-code-solutions)
  - [Table of Contents](#table-of-contents)
  - [Solution for Day 1](#solution-for-day-1)
    - [Description](#description)
    - [Usage](#usage)
    - [Functions](#functions)
  - [Solution for Day 2](#solution-for-day-2)
    - [Description](#description-1)
    - [Usage](#usage-1)
    - [Functions](#functions-1)
  - [Contributing](#contributing)
  - [License](#license)

## Solution for Day 1

### Description
The solution for Day 1 reads pairs of integers from an input file and calculates two metrics:
1. The total distance between the sorted lists of integers.
2. The similarity score based on the frequency of integers in the lists.

### Usage
1. Place your input file named `input.txt` in the root directory of the repository.
2. Run the `advent_one.py` script:
    ```sh
    python advent_one.py
    ```

### Functions
- [calculate_total_distance(left_list, right_list)](advent_one.py): Calculates the total 
distance between two sorted lists.
- [calculate_similarity_score(left_list, right_list)](advent_one.py): Calculates the 
similarity score based on the frequency of integers in the lists.

## Solution for Day 2

### Description
The solution for Day 2 reads lines of integers from an input file and counts the number of "safe" reports based on specific criteria.

### Usage
1. Place your input file named `input.txt` in the root directory of the repository.
2. Run the `advent_two.py` script:
    ```sh
    python advent_two.py
    ```

### Functions
- [is_safe(levels)](advent_two.py): Determines if a list of integers is "safe" based on specific criteria.
- [count_safe_reports(data)](advent_two.py): Counts the number of "safe" reports in the provided data.

## Contributing
Feel free to contribute to this repository by adding new solutions or improving existing ones. To 
contribute:
1. Fork the repository.
2. Create a new branch for your feature or bugfix.
3. Commit your changes.
4. Push to your branch.
5. Create a pull request.

## License
This project is licensed under the MIT License.
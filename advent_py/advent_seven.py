from itertools import product

def evaluate_expression(numbers, operators):
    result = numbers[0]
    for i in range(len(operators)):
        if operators[i] == '+':
            result += numbers[i + 1]
        elif operators[i] == '*':
            result *= numbers[i + 1]
        elif operators[i] == '||':
            result = int(str(result) + str(numbers[i + 1]))
    return result

def possible_equations(test_value, numbers):
    operators = ['+', '*', '||']
    for ops in product(operators, repeat=len(numbers) - 1):
        if evaluate_expression(numbers, ops) == test_value:
            return True
    return False

def total_calibration_result(equations):
    total = 0
    for equation in equations:
        test_value, numbers = equation.split(': ')
        test_value = int(test_value)
        numbers = list(map(int, numbers.split()))
        if possible_equations(test_value, numbers):
            total += test_value
    return total

if __name__ == "__main__":
    with open('input.txt') as f:
        equations = [line.strip() for line in f]
    print(total_calibration_result(equations))
def parse_input(input_data):
    rules_section, updates_section = input_data.strip().split("\n\n")
    rules = [line.strip() for line in rules_section.split("\n")]
    updates = [line.strip() for line in updates_section.split("\n")]
    return rules, updates

def build_graph(rules):
    graph = {}
    for rule in rules:
        before, after = rule.split('|')
        if before not in graph:
            graph[before] = []
        graph[before].append(after)
    return graph

def is_valid_update(update, graph):
    pages = update.split(',')
    positions = {page: idx for idx, page in enumerate(pages)}
    for before, afters in graph.items():
        if before in positions:
            for after in afters:
                if after in positions and positions[before] > positions[after]:
                    return False
    return True

def find_middle_page(update):
    pages = update.split(',')
    middle_index = len(pages) // 2
    return int(pages[middle_index])

def sum_middle_pages(input_data):
    rules, updates = parse_input(input_data)
    graph = build_graph(rules)
    total_sum = 0
    for update in updates:
        if is_valid_update(update, graph):
            total_sum += find_middle_page(update)
    return total_sum

with open("input.txt", "r") as file:
    input_data = file.read()

print("Sum of middle pages:", sum_middle_pages(input_data))
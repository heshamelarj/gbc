window.onload = () => {



  var margin = { top: 10, right: 30, bottom: 30, left: 40 },
    width = 400 - margin.left - margin.right,
    height = 400 - margin.top - margin.bottom;

  // append the svg object to the body of the page
  var svg = d3.select("#mychart")
    .append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform",
      "translate(" + margin.left + "," + margin.top + ")");

  
  // get the data
  d3.json("/admin/app/projet/projetsjson")
  .then((data) => {

    
    let progressData = data.map((item) => (item.budget));
    
    let x = d3.scaleLinear()
      .domain([0, d3.max(progressData,(d) =>  (d+1000))])
      .range([0, width
      ]);
      
    svg.append('g')
      .attr("transform", "translate(0," + height + ")")
      .call(d3.axisBottom(x));

    var histogram = d3.histogram()
      .value(function (d) {
        console.log(d);
       return d; })   // I need to give the vector of value
      .domain(x.domain())  // then the domain of the graphic
      .thresholds(x.ticks(50)); // then the numbers of bins


    // And apply this function to data to get the bins
    var bins = histogram(progressData);

    console.log(bins);
    // Y axis: scale and draw:
    var y = d3.scaleLinear()
      .range([height, 0]);
    y.domain([0, d3.max(bins, function (d) { 
    
       return d.length; })]);   // d3.hist has to be called before the Y axis obviously
    svg.append("g")
      .call(d3.axisLeft(y));

    // Add a tooltip div. Here I define the general feature of the tooltip: stuff that do not depend on the data point.
    // Its opacity is set to 0: we don't see it by default.
    var tooltip = d3.select("#mychart")
      .append("div")
      .style("opacity", 0)
      .attr("class", "tooltip")
      .style("background-color", "black")
      .style("color", "white")
      .style("border-radius", "5px")
      .style("padding", "10px")

    // A function that change this tooltip when the user hover a point.
    // Its opacity is set to 1: we can now see it. Plus it set the text and position of tooltip depending on the datapoint (d)
    var showTooltip = function (d) {
      tooltip
        .transition()
        .duration(100)
        .style("opacity", 1)
      tooltip
        .html("Range: " + d.x0 + " - " + d.x1)
        .style("left", (d3.mouse(this)[0] + 20) + "px")
        .style("top", (d3.mouse(this)[1]) + "px")
    }
    var moveTooltip = function (d) {
      tooltip
        .style("left", (d3.mouse(this)[0] + 20) + "px")
        .style("top", (d3.mouse(this)[1]) + "px")
    }
    // A function that change this tooltip when the leaves a point: just need to set opacity to 0 again
    var hideTooltip = function (d) {
      tooltip
        .transition()
        .duration(100)
        .style("opacity", 0)
    }
    // append the bar rectangles to the svg element
    svg.selectAll("rect")
      .data(bins)
      .enter()
      .append("rect")
      .attr("x", 1)
      .attr("transform", function (d) { return "translate(" + x(d.x0) + "," + y(d.length) + ")"; })
      .attr("width", function (d) { return x(d.x1) - x(d.x0) - 1; })
      .attr("height", function (d) { return height - y(d.length); })
      .style("fill", (d) => {
        if(d.x0 >= 50 && d.x1 >= 50 ) return "green";
        else return "red";
      } )
      // Show tooltip on hover
      .on("mouseover", showTooltip)
      .on("mousemove", moveTooltip)
      .on("mouseleave", hideTooltip);

    let text = svg.selectAll("text")
      .attr("transform", "rotate(-45)");



  })


}